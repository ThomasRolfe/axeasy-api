<?php

namespace App\Services\Scholarships;

use App\Events\ScholarshipCreated;
use App\Models\Company\CompanyInterface;
use App\Models\Scholarship\ScholarshipInterface;
use App\Models\User\UserInterface;
use App\Repositories\Scholarship\ScholarshipRepositoryInterface;
use App\Services\Scholarships\Interfaces\CreatesScholarship;
use App\Services\Scholarships\Interfaces\FindsScholarship;
use App\Services\Scholarships\Interfaces\GetsAllScholarships;
use App\Services\Scholarships\Interfaces\LinksCompanyToScholarship;
use App\Services\Users\Interfaces\GetsAuthedUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ScholarshipService implements CreatesScholarship, FindsScholarship, GetsAllScholarships, LinksCompanyToScholarship
{
    public function __construct(
        protected ScholarshipRepositoryInterface $scholarshipRepository,
        protected GetsAuthedUser $userService
    ) {
    }

    public function create(CompanyInterface $company, array $attributes): Model
    {
        $scholarship = $this->scholarshipRepository->create($attributes);

        ScholarshipCreated::dispatch($company, $scholarship);

        return $scholarship;
    }

    public function allByCompany(CompanyInterface $company): ?Collection
    {
        return $this->scholarshipRepository->allByCompany($company);
    }

    public function allByUser(Authenticatable|UserInterface $user): ?Collection
    {
        return $this->scholarshipRepository->allByUser($user);
    }

    public function find($id): ?Model
    {
        return $this->scholarshipRepository->find($id);
    }

    public function linkCompanyToScholarship(CompanyInterface $company, ScholarshipInterface $scholarship)
    {
        $company->scholarships()->save($scholarship);
    }
}
