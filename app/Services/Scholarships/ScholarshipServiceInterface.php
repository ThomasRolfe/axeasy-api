<?php

namespace App\Services\Scholarships;

use App\Models\User\UserInterface;
use Illuminate\Database\Eloquent\Model;

interface ScholarshipServiceInterface
{
    public function create(UserInterface $user, array $attributes): ?Model;
}
