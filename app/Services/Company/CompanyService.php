<?php

namespace App\Services\Company;

use App\Events\CompanyCreated;
use App\Exceptions\UserCompanyAlreadyExistsException;
use App\Models\User\UserInterface;
use App\Repositories\Company\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CompanyService implements CompanyServiceInterface
{
    public function __construct(protected CompanyRepositoryInterface $companyRepository)
    {
    }

    public function create(UserInterface $user, array $attributes): ?Model
    {
        if ($user->company) {
            throw new UserCompanyAlreadyExistsException('User already connected to a company', 422);
        }

        $company = $this->companyRepository->create($attributes);

        CompanyCreated::dispatch($user, $company);

        return $company;
    }
}
