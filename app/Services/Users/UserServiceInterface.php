<?php

namespace App\Services\Users;

use App\Models\User\UserInterface;

interface UserServiceInterface
{
    /**
     * Return the currently authenticated user
     * @return mixed
     */
    public function authed();
}
