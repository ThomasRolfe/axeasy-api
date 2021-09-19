<?php

namespace App\Services\Scholarships\Interfaces;

use App\Models\Company\CompanyInterface;
use Illuminate\Database\Eloquent\Model;

interface CreatesScholarship
{
    public function create(CompanyInterface $company, array $attributes): ?Model;
}
