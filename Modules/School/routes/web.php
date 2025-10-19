<?php
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // Public routes
    Route::get('/', [\Modules\School\App\Http\Controllers\PublicLandingController::class, 'index'])->name('home');
    Route::get('/welcome', [\Modules\School\App\Http\Controllers\PublicLandingController::class, 'welcome']);

    // Auth routes (hanya untuk guest)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [\Modules\School\App\Http\Controllers\Auth\LoginController::class, 'show'])->name('login');
        Route::post('/login', [\Modules\School\App\Http\Controllers\Auth\LoginController::class, 'login']);
    });

    // Protected routes (harus login)
    Route::middleware(['auth', \Modules\School\App\Http\Middleware\PreventBackHistory::class])->group(function () {
        Route::get('/dashboard', [\Modules\School\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile', [\Modules\School\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [\Modules\School\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

        Route::prefix('students')->name('students.')->group(function () {
            Route::post('import', [\Modules\School\App\Http\Controllers\StudentImportExportController::class, 'import'])->name('import');
            Route::get('export', [\Modules\School\App\Http\Controllers\StudentImportExportController::class, 'export'])->name('export');
            Route::get('template', [\Modules\School\App\Http\Controllers\StudentImportExportController::class, 'downloadTemplate'])->name('template');
        });

        Route::prefix('teachers')->name('teachers.')->group(function () {
            Route::post('import', [\Modules\School\App\Http\Controllers\TeacherImportExportController::class, 'import'])->name('import');
            Route::get('export', [\Modules\School\App\Http\Controllers\TeacherImportExportController::class, 'export'])->name('export');
            Route::get('template', [\Modules\School\App\Http\Controllers\TeacherImportExportController::class, 'downloadTemplate'])->name('template');
        });

        // Resources
        Route::resource('students', \Modules\School\App\Http\Controllers\StudentController::class);
        Route::resource('teachers', \Modules\School\App\Http\Controllers\TeacherController::class);

        Route::resource('classes', \Modules\School\App\Http\Controllers\ClassController::class);
        Route::resource('subjects', \Modules\School\App\Http\Controllers\SubjectController::class);

        // Logout
        Route::post('/logout', [\Modules\School\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    });
});
