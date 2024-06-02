<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;


Route::get('/', [TodoController::class, 'index']);
Route::resource('todo', TodoController::class);
Route::get('todo/delete/{id}', [TodoController::class, 'destroy']);
Route::post('todo/complete/{id}', [TodoController::class, 'complete']);
