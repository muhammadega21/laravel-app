<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetugasController;
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
Route::post('petugas/update/{id_petugas}', [PetugasController::class, 'update'])->middleware('auth');

// Siswa
Route::resource('siswa', SiswaController::class)->middleware('auth');
Route::get('siswa/delete/{id_siswa}', [SiswaController::class, 'destroy'])->middleware('auth');
Route::post('siswa/update/{id_siswa}', [SiswaController::class, 'update'])->middleware('auth');
