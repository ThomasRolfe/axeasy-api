<?php

namespace App\Services\Users\Interfaces;

use App\Models\User\UserInterface;
use Illuminate\Contracts\Auth\Authenticatable;

interface GetsAuthedUser
{
    public function authed(): Authenticatable|UserInterface;
}
