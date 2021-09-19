<?php

namespace App\Services\Scholarships;

use App\Events\ScholarshipCreated;
use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;
use App\Repositories\Scholarship\ScholarshipRepositoryInterface;
use App\Services\Users\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ScholarshipService implements CreatesScholarship, FindsScholarship, GetsAllScholarships
{
    public function __construct(
        protected ScholarshipRepositoryInterface $scholarshipRepository,
        protected UserServiceInterface $userService
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

    public function allByUser(UserInterface $user): ?Collection
    {
        return $this->scholarshipRepository->allByUser($user);
    }

    public function find($id): ?Model
    {
        return $this->scholarshipRepository->find($id);
    }
}
