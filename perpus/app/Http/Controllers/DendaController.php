<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class DendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('admin')) {
                abort(404);
            }
            return $next($request);
        })->only(['store', 'update', 'destroy', 'bayar_denda']);
    }

    public function index()
    {
        if (Auth()->user()->role == 3) {
            $data = Denda::where('siswa_id', Auth()->user()->siswa->id)->get();
        } else {
            $data = Denda::all();
        }
        return view('denda', [
            'title' => "Data Denda",
            'main_page' => '',
            'page' => 'Data Denda',
            'datas' => $data,
            'pengembalian' => Pengembalian::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pengembalian = Pengembalian::find($request->pengembalian_id);

        $biayaDenda =  preg_replace('/[^0-9]/', '', $request->input('biaya_denda'));

        $validator = Validator::make($request->all(), [
            'pengembalian_id' => 'required',
            'nama_denda' => 'required|max:20',
            'biaya_denda' => 'required',
        ], [

            'pengembalian_id.required' => 'ID Pengembalian Tidak Boleh Kosong!',

            'nama_denda.required' => 'Nama Denda Tidak Boleh Kosong!',
            'nama_denda.max' => 'Nama Denda Maksimal 20 Karakter!',

            'biaya_denda.required' => 'Biaya Denda Tidak Boleh Kosong!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('addDenda', 'Gagal Menambah Denda');
        }

        // id_denda
        $lastId = Denda::latest('id_denda')->first();
        $nextId = $lastId ? substr($lastId->id_denda, 1) + 1 : 1;
        $idDenda = 'D' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        Denda::create([
            'siswa_id' => $pengembalian->siswa->id,
            'buku_id' => $pengembalian->buku->id,
            'pengembalian_id' => $request->input('pengembalian_id'),
            'id_denda' => $idDenda,
            'nama_denda' => $request->input('nama_denda'),
            'biaya_denda' => $biayaDenda,
        ]);

        return redirect('/denda')->with('success', 'Berhasil menambah Denda');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_denda)
    {
        $biayaDenda =  preg_replace('/[^0-9]/', '', $request->input('biaya_denda'));

        $validator = Validator::make($request->all(), [
            'nama_denda' => 'required|max:20',
            'biaya_denda' => 'required',
        ], [
            'pengembalian_id.required' => 'ID Pengembalian Tidak Boleh Kosong!',

            'nama_denda.required' => 'Nama Denda Tidak Boleh Kosong!',
            'nama_denda.max' => 'Nama Denda Maksimal 20 Karakter!',

            'biaya_denda.required' => 'Biaya Denda Tidak Boleh Kosong!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('updateDeda', 'Gagal Update Deda');
        }


        Denda::where('id_denda', $id_denda)->update([
            'nama_denda' => $request->input('nama_denda'),
            'biaya_denda' => $biayaDenda,
        ]);

        return redirect('/denda')->with('success', 'Berhasil update denda');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_denda)
    {
        $denda = Denda::where('id_denda', $id_denda)->first();

        Denda::destroy($denda->id);
        return redirect('/denda')->with('success', 'Berhasil menghapus data');
    }

    public function bayar_denda(string $id_denda)
    {
        Denda::where('id_denda', $id_denda)->update([
            'status' => 1
        ]);

        return redirect('/denda')->with('success', 'Berhasil melunasi denda');
    }
}
