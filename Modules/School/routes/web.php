<?php

use Illuminate\Support\Facades\Route;
use Modules\School\App\Http\Controllers\Auth\LoginController;
use Modules\School\App\Http\Controllers\DashboardController;
use Modules\School\App\Http\Controllers\ProfileController;
use Modules\School\App\Http\Controllers\PublicLandingController;

// Landing publik (tanpa login)
Route::get('/', [PublicLandingController::class, 'index']);
Route::get('/welcome', [PublicLandingController::class, 'welcome']);

// Auth
Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout']);

// Dashboard (harus login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::post('/profile', [ProfileController::class, 'update']);
});
