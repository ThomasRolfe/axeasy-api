<?php

namespace App\Repositories\Scholarship;

use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;
use Illuminate\Database\Eloquent\Collection;

interface ScholarshipRepositoryInterface
{
    public function allByUser(UserInterface $user): ?Collection;
    public function allByCompany(CompanyInterface $company): ?Collection;
}
