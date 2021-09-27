<?php

namespace App\Repositories\Company;

use Illuminate\Database\Eloquent\Model;

interface CompanyRepositoryInterface
{
    public function create(array $attributes): ?Model;
}
