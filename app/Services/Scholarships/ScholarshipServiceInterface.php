<?php

namespace App\Services\Scholarships;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface ScholarshipServiceInterface
{
    public function allByUser(): ?Collection;
    public function find($id): ?Model;
}
