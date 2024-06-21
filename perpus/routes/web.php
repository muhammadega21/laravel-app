<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;

// Auth
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login')->middleware('guest');
    Route::get('/login', 'index')->middleware('guest');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->middleware('auth');
    Route::get('/register', 'register')->middleware('guest');
    Route::post('/register', 'registerStore');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/dashboard', 'index')->middleware('auth')->name('dashboard');
});

Route::resource('petugas', PetugasController::class)->middleware('auth');
