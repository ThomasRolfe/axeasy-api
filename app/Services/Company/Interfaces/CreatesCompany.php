<?php

namespace App\Services\Company\Interfaces;

use App\Models\User\UserInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

interface CreatesCompany
{
    public function create(Authenticatable|UserInterface $user, array $attributes): ?Model;
}
