<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function () {
    require base_path('routes/Users/users.php');
    require base_path('routes/Companies/companies.php');
    require base_path('routes/Scholarships/scholarships.php');


});
