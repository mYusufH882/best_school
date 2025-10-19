<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', [\Modules\School\App\Http\Controllers\PublicLandingController::class, 'index']);
    Route::get('/welcome', [\Modules\School\App\Http\Controllers\PublicLandingController::class, 'welcome']);

    Route::get('/login', [\Modules\School\App\Http\Controllers\Auth\LoginController::class, 'show']);
    Route::post('/login', [\Modules\School\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
    Route::post('/logout', [\Modules\School\App\Http\Controllers\Auth\LoginController::class, 'logout']);

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [\Modules\School\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [\Modules\School\App\Http\Controllers\ProfileController::class, 'edit']);
        Route::post('/profile', [\Modules\School\App\Http\Controllers\ProfileController::class, 'update']);

        Route::resource('schools', \Modules\School\App\Http\Controllers\SchoolController::class);
        Route::resource('students', \Modules\School\App\Http\Controllers\StudentController::class);
        Route::resource('teachers', \Modules\School\App\Http\Controllers\TeacherController::class);
        Route::resource('classes', \Modules\School\App\Http\Controllers\ClassController::class);
    });
});
