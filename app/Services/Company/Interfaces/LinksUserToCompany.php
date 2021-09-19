<?php

namespace App\Services\Company\Interfaces;

use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;

interface LinksUserToCompany
{
    public function linkUserToCompany(UserInterface $user, CompanyInterface $company);
}
