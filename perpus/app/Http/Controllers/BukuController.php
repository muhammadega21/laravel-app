<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('katalog.buku', [
            'title' => "Buku",
            'main_page' => 'Katalog',
            'page' => 'Buku',
            'datas' => Buku::all(),
            'rak' => Rak::all()
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
            'judul' => 'required|max:100|unique:bukus,judul',
            'rak_id' => 'required',
            'isbn' => 'max:15',
            'tahun_terbit' => 'max:4',
            'jumlah' => 'required',
            'bahasa' => 'max:30',
        ], [
            'judul.required' => 'Judul Tidak Boleh Kosong!',
            'judul.max' => 'Judul Maksimal 100 Karakter!',
            'judul.unique' => 'Judul Sudah Ada!',

            'rak.required' => 'Rak Tidak Boleh Kosong!',

            'isbn.max' => 'Username Maksimal 15 Karakter!',

            'tahun_terbit.max' => 'Tahun Terbit Maksimal 4 Karakter!',

            'jumlah.required' => 'Jumlah Tidak Boleh Kosong!',

            'bahasa.max' => 'Bahasa Maksimal 30 Karakter!',
        ]);

        $slug = Str::slug($request->judul);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('addBuku', 'Gagal Menambah Buku');
        }


        Buku::create([
            'judul' => $request->input('judul'),
            'slug' => $slug,
            'rak_id' => $request->input('rak_id'),
            'isbn' => $request->input('isbn'),
            'pengarang' => $request->input('pengarang'),
            'penerbit' => $request->input('penerbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'tempat_terbit' => $request->input('tempat_terbit'),
            'jumlah' => $request->input('jumlah'),
            'bahasa' => $request->input('bahasa'),
            'halaman' => $request->input('halaman'),
        ]);

        return redirect('/buku')->with('success', 'Berhasil menambah Buku');
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
