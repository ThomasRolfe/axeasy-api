<?php

namespace App\Services\Users;

use App\Services\Users\Interfaces\GetsAuthedUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User\UserInterface;

class UserService implements GetsAuthedUser
{
    public function authed(): Authenticatable|UserInterface
    {
        return Auth::user();
    }
}
