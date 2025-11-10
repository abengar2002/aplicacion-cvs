<?php

use App\Http\Controllers\CvController;
use Illuminate\Support\Facades\Route;

//Al cargar la página:
Route::get('/', [CvController::class, 'index'])->name('inicio');

//Las rutas
Route::resource('cvs', CvController::class);