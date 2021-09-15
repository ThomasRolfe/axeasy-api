<?php

namespace App\Services\Users;

use App\Models\User\UserInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    public function authed()
    {
        return Auth::user();
    }
}
