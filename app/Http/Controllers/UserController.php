<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\Users\Interfaces\GetsAuthedUser;

class UserController extends Controller
{
    public function __construct(protected GetsAuthedUser $userService)
    {
    }

    public function show()
    {
        return new UserResource($this->userService->authed()->load('company'));
    }
}
