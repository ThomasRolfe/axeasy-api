<?php

namespace App\Services\Scholarships\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface FindsScholarship
{
    public function find($id): ?Model;
}
