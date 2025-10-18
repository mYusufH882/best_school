<?php

use Illuminate\Support\Facades\Route;
use Modules\School\App\Http\Controllers\SchoolController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('schools', SchoolController::class)->names('school');
});
