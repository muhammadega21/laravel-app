<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;


class KelasController extends Controller
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
        return view('master-data.kelas', [
            'title' => "Kelas",
            'main_page' => 'Master',
            'page' => 'Kelas',
            'datas' => Kelas::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|unique:kelas,nama_kelas|max:10',
            'status' => 'required',
        ], [
            'nama_kelas.required' => 'Nama Kelas Tidak Boleh Kosong!',
            'nama_kelas.unique' => 'Nama Kelas Sudah Ada!',
            'nama_kelas.max' => 'Max 10 Karakter!',

            'status.required' => 'Status Tidak Boleh Kosong!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('addKelas', 'Gagal Menambah Kelas');
        }

        Kelas::create([
            'nama_kelas' => $request->input('nama_kelas'),
            'status' => $request->input('status'),
        ]);

        return redirect('/kelas')->with('success', 'Berhasil Menambah Kelas');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = Kelas::where('id', $id)->first();
        $rules = [
            'status' => 'required'
        ];

        if ($request->nama_kelas != $data->nama_kelas) {
            $rules['nama_kelas'] = 'required|unique:kelas,nama_kelas|max:10';
        }

        $validator = Validator::make($request->all(), $rules, [
            'nama_kelas.required' => 'Nama Kelas Tidak Boleh Kosong!',
            'nama_kelas.unique' => 'Nama Kelas Sudah Ada!',
            'nama_kelas.max' => 'Max 10 Karakter!',

            'status.required' => 'Status Tidak Boleh Kosong!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('updateKelas', 'Gagal Update Kelas');
        }

        Kelas::where('id', $data->id)->update([
            'nama_kelas' => $request->input('nama_kelas'),
            'status' => $request->input('status'),
        ]);

        return redirect('/kelas')->with('success', 'Berhasil Update Kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $kelas = Kelas::where('id', $id)->first();
        Kelas::destroy($kelas->id);
        return redirect('/kelas')->with('success', 'Berhasil menghapus kelas');
    }
}
