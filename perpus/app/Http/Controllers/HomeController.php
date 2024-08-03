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
            $pengembalian = Buku::where('siswa_id', Auth()->user()->siswa->id)->get();
        } else {
            $peminjaman = Peminjaman::all();
            $denda = Denda::all();
            $pengembalian = Buku::all();
        }
        // Chart
        $monthNow = date('m');
        $chartLabels = [];
        $chartDataSets = [];
        if ($monthNow <= 6) {
            $chartLabels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli'];
            $chartDataSets = [
                [
                    'label' => 'Peminjaman',
                    'data' => [
                        Peminjaman::whereMonth('created_at', 1)->get()->count(),
                        Peminjaman::whereMonth('created_at', 2)->get()->count(),
                        Peminjaman::whereMonth('created_at', 3)->get()->count(),
                        Peminjaman::whereMonth('created_at', 4)->get()->count(),
                        Peminjaman::whereMonth('created_at', 5)->get()->count(),
                        Peminjaman::whereMonth('created_at', 6)->get()->count(),
                    ],
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => (int) 0.1
                ],
                [
                    'label' => 'Buku Masuk',
                    'data' => [
                        Buku::whereMonth('created_at', 1)->get()->count(),
                        Buku::whereMonth('created_at', 2)->get()->count(),
                        Buku::whereMonth('created_at', 3)->get()->count(),
                        Buku::whereMonth('created_at', 4)->get()->count(),
                        Buku::whereMonth('created_at', 5)->get()->count(),
                        Buku::whereMonth('created_at', 6)->get()->count(),
                    ],
                    'fill' => false,
                    'borderColor' => 'rgb(38, 232, 35)',
                    'tension' => (int) 0.1
                ],
                [
                    'label' => 'Siswa',
                    'data' => [
                        Siswa::whereMonth('created_at', 1)->get()->count(),
                        Siswa::whereMonth('created_at', 2)->get()->count(),
                        Siswa::whereMonth('created_at', 3)->get()->count(),
                        Siswa::whereMonth('created_at', 4)->get()->count(),
                        Siswa::whereMonth('created_at', 5)->get()->count(),
                        Siswa::whereMonth('created_at', 6)->get()->count(),
                    ],
                    'fill' => false,
                    'borderColor' => 'rgb(222, 121, 7)',
                    'tension' => (int) 0.1
                ]
            ];
        } else {
            $chartLabels = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $chartDataSets = [
                [
                    'label' => 'Peminjaman',
                    'data' => [
                        Peminjaman::whereMonth('created_at', 7)->get()->count(),
                        Peminjaman::whereMonth('created_at', 8)->get()->count(),
                        Peminjaman::whereMonth('created_at', 9)->get()->count(),
                        Peminjaman::whereMonth('created_at', 10)->get()->count(),
                        Peminjaman::whereMonth('created_at', 11)->get()->count(),
                        Peminjaman::whereMonth('created_at', 12)->get()->count(),
                    ],
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => (int) 0.1
                ],
                [
                    'label' => 'Buku Masuk',
                    'data' => [
                        Buku::whereMonth('created_at', 7)->get()->count(),
                        Buku::whereMonth('created_at', 8)->get()->count(),
                        Buku::whereMonth('created_at', 9)->get()->count(),
                        Buku::whereMonth('created_at', 10)->get()->count(),
                        Buku::whereMonth('created_at', 11)->get()->count(),
                        Buku::whereMonth('created_at', 12)->get()->count(),
                    ],
                    'fill' => false,
                    'borderColor' => 'rgb(38, 232, 35)',
                    'tension' => (int) 0.1
                ],
                [
                    'label' => 'Siswa',
                    'data' => [
                        Siswa::whereMonth('created_at', 7)->get()->count(),
                        Siswa::whereMonth('created_at', 8)->get()->count(),
                        Siswa::whereMonth('created_at', 9)->get()->count(),
                        Siswa::whereMonth('created_at', 10)->get()->count(),
                        Siswa::whereMonth('created_at', 11)->get()->count(),
                        Siswa::whereMonth('created_at', 12)->get()->count(),
                    ],
                    'fill' => false,
                    'borderColor' => 'rgb(222, 121, 7)',
                    'tension' => (int) 0.1
                ]
            ];
        }
        $chartData = [
            'labels' => $chartLabels,
            'datasets' => $chartDataSets
        ];

        return view('/dashboard', [
            'title' => "Dashboard",
            'main_page' => '',
            'page' => 'Dashboard',
            'siswa' => Siswa::all()->count(),
            'petugas' => Petugas::all()->count(),
            'kelas' => Kelas::all()->count(),
            'buku' => Buku::all(),
            'peminjaman' => $peminjaman,
            'pengembalian' => $pengembalian,
            'denda' => $denda,
            'chartData' => $chartData
        ]);
    }
}
