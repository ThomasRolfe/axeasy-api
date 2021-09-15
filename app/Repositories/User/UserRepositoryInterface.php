<?php

namespace App\Repositories\User;

use Illuminate\Contracts\Auth\Authenticatable;

interface UserRepositoryInterface
{
    public function current(): ?Authenticatable;
}
