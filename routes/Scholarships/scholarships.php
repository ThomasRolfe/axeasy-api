<?php

use App\Http\Controllers\ScholarshipController;
use Illuminate\Support\Facades\Route;

Route::get('/scholarships', [ScholarshipController::class, 'index']);
Route::get('/scholarships/{encodedId}', [ScholarshipController::class, 'show']);
Route::post('/scholarships', [ScholarshipController::class, 'create']);
