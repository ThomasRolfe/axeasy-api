<?php

namespace App\Services\Scholarships;

use Illuminate\Database\Eloquent\Model;

interface FindsScholarship
{
    public function find($id): ?Model;
}
