<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', [
        'title' => 'Dashboard',
        'main_page' => '',
        'page' => 'Dashboard',
        'data' => 300
    ]);
});
