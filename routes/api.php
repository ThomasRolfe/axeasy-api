<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/user', [UserController::class, 'show']);
    Route::get('/scholarships', [ScholarshipController::class, 'index']);
    Route::get('/scholarships/{encodedId}', [ScholarshipController::class, 'show']);
    Route::post('/scholarships', [ScholarshipController::class, 'create']);

    Route::post('/companies', [CompanyController::class, 'create']);
});
