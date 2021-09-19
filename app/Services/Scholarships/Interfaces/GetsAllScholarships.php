<?php

namespace App\Services\Scholarships\Interfaces;

use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;

interface GetsAllScholarships
{
    public function allByUser(Authenticatable|UserInterface $user): ?Collection;
    public function allByCompany(CompanyInterface $company): ?Collection;
}
