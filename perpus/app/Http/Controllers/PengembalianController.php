<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth()->user()->role == 3) {
            $data = Pengembalian::where('siswa_id', Auth()->user()->siswa->id)->get();
        } else {
            $data = Pengembalian::all();
        }

        return view('pengembalian', [
            'title' => "Data Pengembalian",
            'main_page' => '',
            'page' => 'Data Pengembalian',
            'datas' => $data,
        ]);
    }
}
