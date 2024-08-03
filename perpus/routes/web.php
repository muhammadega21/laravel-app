<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

// Auth
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login')->middleware('guest');
    Route::get('/login', 'index')->middleware('guest');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->middleware('auth');
    Route::get('/register', 'register')->middleware('guest');
    Route::post('/register', 'registerStore')->name('registerStore');
});


Route::controller(HomeController::class)->group(function () {
    Route::get('/dashboard', 'index')->middleware('auth')->name('dashboard');
});

// Petugas
Route::resource('petugas', PetugasController::class)->middleware('auth');
Route::get('petugas/delete/{id_petugas}', [PetugasController::class, 'destroy'])->middleware('auth');
Route::put('petugas/update/{id_petugas}', [PetugasController::class, 'update'])->middleware('auth');

// Siswa
Route::resource('siswa', SiswaController::class)->middleware('auth');
Route::get('siswa/show/{id_siswa}', [SiswaController::class, 'show'])->middleware('auth');
Route::get('siswa/delete/{id_siswa}', [SiswaController::class, 'destroy'])->middleware('auth');
Route::put('siswa/update/{id_siswa}', [SiswaController::class, 'update'])->middleware('auth');

// Kelas
Route::resource('kelas', KelasController::class)->middleware('auth');
Route::get('kelas/delete/{id}', [KelasController::class, 'destroy'])->middleware('auth');
Route::put('kelas/update/{id}', [KelasController::class, 'update'])->middleware('auth');

// Buku
Route::resource('buku', BukuController::class)->middleware('auth');
Route::get('buku/delete/{id}', [BukuController::class, 'destroy'])->middleware('auth');
Route::put('buku/update/{id}', [BukuController::class, 'update'])->middleware('auth');
Route::get('daftar_buku', [BukuController::class, 'daftar_buku'])->middleware('auth');
Route::get('daftar_buku/{slug}', [BukuController::class, 'show'])->middleware('auth');

// Rak
Route::resource('rak', RakController::class)->middleware('auth');
Route::get('rak/delete/{slug}', [RakController::class, 'destroy'])->middleware('auth');
Route::put('rak/update/{id}', [RakController::class, 'update'])->middleware('auth');

// Peminjaman
Route::resource('peminjaman', PeminjamanController::class)->middleware('auth');
Route::get('peminjaman/delete/{slug}', [PeminjamanController::class, 'destroy'])->middleware('auth');
Route::put('peminjaman/update/{id}', [PeminjamanController::class, 'update'])->middleware('auth');
Route::get('peminjaman/kembali/{id_pinjam}', [PeminjamanController::class, 'pengembalian'])->middleware('auth');

// Pengembalian
Route::resource('pengembalian', PengembalianController::class)->middleware('auth');
Route::get('pengembalian/delete/{slug}', [PengembalianController::class, 'destroy'])->middleware('auth');
Route::put('pengembalian/update/{id}', [PengembalianController::class, 'update'])->middleware('auth');

// Denda
Route::resource('denda', DendaController::class)->middleware('auth');
Route::get('denda/delete/{id_denda}', [DendaController::class, 'destroy'])->middleware('auth');
Route::put('denda/update/{id_denda}', [DendaController::class, 'update'])->middleware('auth');
Route::get('denda/bayar/{id_denda}', [DendaController::class, 'bayar_denda'])->middleware('auth');

// Profile
Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'index')->middleware('auth');
    Route::put('/profile/update', 'update')->middleware('auth');
    Route::put('/profile/change_password', 'changePassword')->middleware('auth');
    Route::get('/profile/delete-image', 'deleteImage')->middleware('auth');
});
