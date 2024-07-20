<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('peminjaman', [
            'title' => "Data Peminjaman",
            'main_page' => '',
            'page' => 'Data Peminjaman',
            'datas' => Peminjaman::all(),
            'siswa' => Siswa::all(),
            'buku' => Buku::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $idPinjam = 'P' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
