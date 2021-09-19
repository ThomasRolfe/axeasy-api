<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::post('/companies', [CompanyController::class, 'create']);
