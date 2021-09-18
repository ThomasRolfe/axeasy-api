<?php

namespace App\Services\Scholarships;

use App\Models\Company\CompanyInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface ScholarshipServiceInterface
{
    public function create(CompanyInterface $company, array $attributes): ?Model;
    public function allByUser(): ?Collection;
    public function find($id): ?Model;
}
