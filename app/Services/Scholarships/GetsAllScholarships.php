<?php

namespace App\Services\Scholarships;

use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;
use Illuminate\Support\Collection;

interface GetsAllScholarships
{
    public function allByUser(UserInterface $user): ?Collection;
    public function allByCompany(CompanyInterface $company): ?Collection;
}
