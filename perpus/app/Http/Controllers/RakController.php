<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class RakController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('admin')) {
                abort(404);
            }
            return $next($request);
        })->only(['index', 'store', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('katalog.rak', [
            'title' => "Rak",
            'main_page' => 'Katalog',
            'page' => 'Rak',
            'datas' => Rak::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_rak' => 'required|max:20|unique:raks,nama_rak',
        ], [

            'nama_rak.required' => 'Nama Rak Tidak Boleh Kosong!',
            'nama_rak.max' => 'Max 20 Karakter!',
            'nama_rak.unique' => 'Nama Rak Sudah Ada!',


        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('addRak', 'Gagal Menambah Rak');
        }

        // id_siswa
        $lastId = Rak::latest('id_rak')->first();
        $nextId = $lastId ? substr($lastId->id_rak, 1) + 1 : 1;
        $idRak = 'R' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        Rak::create([
            'id_rak' => $idRak,
            'nama_rak' => $request->input('nama_rak'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return redirect('/rak')->with('success', 'Berhasil menambah rak');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Rak::where('id_rak', $id)->first();

        $rules = [];

        if ($request->nama_rak != $data->nama_rak) {
            $rules['nama_rak'] = 'required|max:20|unique:raks,nama_rak';
        }

        $validator = Validator::make($request->all(), $rules, [
            'nama_rak.required' => 'Nama Rak Tidak Boleh Kosong!',
            'nama_rak.max' => 'Max 20 Karakter!',
            'nama_rak.unique' => 'Nama Rak Sudah Ada!',


        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('updateRak', 'Gagal Update Rak');
        }

        Rak::where('id', $data->id)->update([
            'nama_rak' => $request->input('nama_rak'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return redirect('/rak')->with('success', 'Berhasil update rak');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rak = Rak::where('id_rak', $id)->first();
        Rak::destroy($rak->id);
        return redirect('/rak')->with('success', 'Berhasil menghapus data');
    }
}
