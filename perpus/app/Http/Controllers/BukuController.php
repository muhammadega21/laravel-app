<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Rak;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class BukuController extends Controller
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
        })->only(['index', 'store', 'update', 'destroy']);
    }

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->can)
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

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $image = $request->file('image')->store('book-image');
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('addBuku', 'Gagal Menambah Buku');
        }


        Buku::create([
            'judul' => $request->input('judul'),
            'slug' => $slug,
            'rak_id' => $request->input('rak_id'),
            'isbn' => $request->input('isbn'),
            'sinopsis' => $request->input('sinopsis'),
            'pengarang' => $request->input('pengarang'),
            'penerbit' => $request->input('penerbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'tempat_terbit' => $request->input('tempat_terbit'),
            'jumlah' => $request->input('jumlah'),
            'bahasa' => $request->input('bahasa'),
            'halaman' => $request->input('halaman'),
            'image' => $image,
        ]);

        return redirect('/buku')->with('success', 'Berhasil Menambah Buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $buku = Buku::where('slug', $slug)->first();
        return view('show_buku', [
            'title' => "Detail Buku",
            'main_page' => 'Daftar Buku',
            'page' => 'Detail Buku',
            'buku' => $buku
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $data = Buku::where('slug', $slug)->first();
        $rules = [
            'rak_id' => 'required',
            'isbn' => 'max:15',
            'tahun_terbit' => 'max:4',
            'jumlah' => 'required',
            'bahasa' => 'max:30'
        ];

        if ($request->judul != $data->judul) {
            $rules['judul'] = 'required|max:100|unique:bukus,judul';
        }

        $validator = Validator::make($request->all(), $rules, [
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

        $image = $request->oldImage;
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $image = $request->file('image')->store('book-image');
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('updateBuku', 'Gagal Update Buku');
        }


        Buku::where('id', $data->id)->update([
            'judul' => $request->input('judul'),
            'slug' => $slug,
            'rak_id' => $request->input('rak_id'),
            'isbn' => $request->input('isbn'),
            'sinopsis' => $request->input('sinopsis'),
            'pengarang' => $request->input('pengarang'),
            'penerbit' => $request->input('penerbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'tempat_terbit' => $request->input('tempat_terbit'),
            'jumlah' => $request->input('jumlah'),
            'bahasa' => $request->input('bahasa'),
            'halaman' => $request->input('halaman'),
            'image' => $image,
        ]);

        return redirect('/buku')->with('success', 'Berhasil Update Buku');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $buku = Buku::where('slug', $slug)->first();
        Buku::destroy($buku->id);
        return redirect('/buku')->with('success', 'Berhasil menghapus data');
    }

    public function daftar_buku()
    {
        return view('daftar_buku', [
            'title' => "Daftar Buku",
            'main_page' => '',
            'page' => 'Daftar Buku',
            'datas' => Buku::all(),
            'rak' => Rak::all()
        ]);
    }
}
