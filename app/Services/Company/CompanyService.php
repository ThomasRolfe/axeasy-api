<?php

namespace App\Services\Company;

use App\Events\CompanyCreated;
use App\Exceptions\UserCompanyAlreadyExists;
use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Services\Company\Interfaces\CreatesCompany;
use App\Services\Company\Interfaces\LinksUserToCompany;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class CompanyService implements CreatesCompany, LinksUserToCompany
{
    public function __construct(protected CompanyRepositoryInterface $companyRepository)
    {
    }

    public function create(Authenticatable|UserInterface $user, array $attributes): ?Model
    {
        if ($user->company) {
            throw new UserCompanyAlreadyExists('User already connected to a company', 422);
        }

        $company = $this->companyRepository->create($attributes);

        CompanyCreated::dispatch($user, $company);

        return $company;
    }

    public function linkUserToCompany(UserInterface $user, CompanyInterface $company): void
    {
        if($user->company) {
            throw new UserCompanyAlreadyExists('User already connected to a company', 422);
        }

        $user->company()->associate($company)->save();
    }
}
