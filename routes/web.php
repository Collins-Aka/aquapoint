<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/detect-objects', [ImageController::class, 'showForm'])->name('detect-objects-form');
Route::post('/detect-objects', [ImageController::class, 'detectObjects'])->name('detect-objects');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
