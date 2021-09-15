<?php

namespace App\Services\Scholarships;

use Illuminate\Database\Eloquent\Model;

interface ScholarshipServiceInterface
{
    public function create(array $attributes): ?Model;
}
