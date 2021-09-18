<?php

namespace App\Services\Users;

use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    public function authed()
    {
        return Auth::user();
    }
}
