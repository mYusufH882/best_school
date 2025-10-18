<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\App\Http\Controllers\HomeController;
use Modules\Core\App\Http\Controllers\RegisterController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/daftar', [RegisterController::class, 'show']);
Route::post('/daftar', [RegisterController::class, 'store'])->name('core.register.store');
