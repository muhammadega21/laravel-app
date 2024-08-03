<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Denda;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;


class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('admin')) {
                abort(404);
            }
            return $next($request);
        })->only(['store', 'update', 'destroy', 'pengembalian']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth()->user()->role == 3) {
            $data = Peminjaman::where('siswa_id', Auth()->user()->siswa->id)->get();
        } else {
            $data = Peminjaman::all();
        }
        return view('peminjaman', [
            'title' => "Data Peminjaman",
            'main_page' => '',
            'page' => 'Data Peminjaman',
            'datas' => $data,
            'siswa' => Siswa::all(),
            'buku' => Buku::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'buku_id' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
        ], [

            'siswa_id.required' => 'Siswa Tidak Boleh Kosong!',

            'buku_id.required' => 'Buku Tidak Boleh Kosong!',

            'tgl_pinjam.required' => 'Tanggal Pinjam Tidak Boleh Kosong!',

            'tgl_kembali.required' => 'Tanggal Kembali Tidak Boleh Kosong!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('addPeminjaman', 'Gagal Menambah Peminjaman');
        }

        // id_pinjam
        $lastId = Peminjaman::latest('id_pinjam')->first();
        $nextId = $lastId ? substr($lastId->id_pinjam, 1) + 1 : 1;
        $idPinjam = 'P' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        Peminjaman::create([
            'id_pinjam' => $idPinjam,
            'petugas_id' => Auth::user()->petugas->id,
            'siswa_id' => $request->input('siswa_id'),
            'buku_id' => $request->input('buku_id'),
            'tgl_pinjam' => $request->input('tgl_pinjam'),
            'tgl_kembali' => $request->input('tgl_kembali'),
        ]);

        return redirect('/peminjaman')->with('success', 'Berhasil menambah Peminjaman');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {

        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'buku_id' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
        ], [

            'siswa_id.required' => 'Siswa Tidak Boleh Kosong!',

            'buku_id.required' => 'Buku Tidak Boleh Kosong!',

            'tgl_pinjam.required' => 'Tanggal Pinjam Tidak Boleh Kosong!',

            'tgl_kembali.required' => 'Tanggal Kembali Tidak Boleh Kosong!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('updatePeminjaman', 'Gagal Update Peminjaman');
        }


        Peminjaman::where('id', $id)->update([
            'siswa_id' => $request->input('siswa_id'),
            'buku_id' => $request->input('buku_id'),
            'tgl_pinjam' => $request->input('tgl_pinjam'),
            'tgl_kembali' => $request->input('tgl_kembali'),
        ]);

        return redirect('/peminjaman')->with('success', 'Berhasil update peminjaman');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $peminjaman = Peminjaman::where('id', $id)->first();
        Peminjaman::destroy($peminjaman->id);
        return redirect('/peminjaman')->with('success', 'Berhasil menghapus data');
    }

    public function pengembalian(string $id_pinjam)
    {
        $peminjaman = Peminjaman::where('id_pinjam', $id_pinjam)->first();


        // check date
        $tgl_kembali = date_create($peminjaman->tgl_kembali);
        $date_now = date_create(date('Y-m-d'));

        // id_kembali
        $lastId = Pengembalian::latest('id_kembali')->first();
        $nextId = $lastId ? substr($lastId->id_kembali, 1) + 1 : 1;
        $idKembali = 'K' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        // id_denda
        $lastId = Denda::latest('id_denda')->first();
        $nextId = $lastId ? substr($lastId->id_denda, 1) + 1 : 1;
        $idDenda = 'D' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        $pengembalian = Pengembalian::create([
            'siswa_id' => $peminjaman->siswa_id,
            'petugas_id' => Auth()->user()->petugas->id,
            'buku_id' => $peminjaman->buku_id,
            'id_kembali' => $idKembali,
            'tgl_kembali' => date('Y-m-d'),
        ]);

        $peminjaman->update([
            'status' => 1
        ]);

        if ($date_now > $tgl_kembali) {
            $terlambat = date_diff(
                $date_now,
                $tgl_kembali
            )->format('%a');
            $denda = $terlambat * 1000;

            Denda::create([
                'siswa_id' => $peminjaman->siswa_id,
                'buku_id' => $peminjaman->buku_id,
                'pengembalian_id' => $pengembalian->id,
                'id_denda' => $idDenda,
                'nama_denda' => 'Terlambat',
                'biaya_denda' => $denda
            ]);
        }

        return redirect('/peminjaman')->with('success', 'Berhasil Mengembalikan Buku');
    }
}
