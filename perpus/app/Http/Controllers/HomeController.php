<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Denda;
use App\Models\Kelas;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Petugas;
use App\Models\Siswa;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth()->user()->role === 3) {
            $peminjaman = Peminjaman::where('siswa_id', Auth()->user()->siswa->id)->get();
            $denda = Denda::where('siswa_id', Auth()->user()->siswa->id)->get();
            $pengembalian = Pengembalian::where('siswa_id', Auth()->user()->siswa->id)->get();
        } else {
            $peminjaman = Peminjaman::all();
            $denda = Denda::all();
            $pengembalian = Pengembalian::all();
        }
        return view('/dashboard', [
            'title' => "Dashboard",
            'main_page' => '',
            'page' => 'Dashboard',
            'siswa' => Siswa::all()->count(),
            'petugas' => Petugas::all()->count(),
            'kelas' => Kelas::all()->count(),
            'buku' => Buku::all()->count(),
            'peminjaman' => $peminjaman->count(),
            'pengembalian' => $pengembalian->count(),
            'denda' => $denda->count(),
        ]);
    }
}
