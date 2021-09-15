<?php

namespace App\Services\Scholarships;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

interface ScholarshipServiceInterface
{
    public function create(User $user, array $attributes): ?Model;
}
