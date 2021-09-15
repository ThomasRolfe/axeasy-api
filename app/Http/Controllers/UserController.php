<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\Users\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(protected UserServiceInterface $userService)
    {
    }

    public function show()
    {
        return new UserResource($this->userService->authed()->load('company'));
    }
}
