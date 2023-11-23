<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('home');
Route::get('/todos', [TodoController::class, 'index']);
Route::resource('todos', TodoController::class)->only('store', 'update');
