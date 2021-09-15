<?php

namespace App\Services\Scholarships;

use App\Exceptions\UserCompanyNotFoundException;
use App\Models\Scholarship\Scholarship;
use App\Models\User\User;
use App\Repositories\Scholarship\ScholarshipRepositoryInterface;
use App\Services\Users\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ScholarshipService implements ScholarshipServiceInterface
{
    public function __construct(
        protected ScholarshipRepositoryInterface $scholarshipRepository,
        protected UserServiceInterface $userService
    ) {
    }

    public function create(User $user, array $attributes): Model
    {
        if (!$user->company) {
            throw new UserCompanyNotFoundException('User is required to be connected to a company to create a scholarship',
                422);
        }

        $scholarship = $this->scholarshipRepository->create($attributes);

        $user->company->scholarships()->save($scholarship);

        return $scholarship;
    }

    public function all(): ?Collection
    {
        return $this->scholarshipRepository->allAuthed($this->userService->authed());
    }

    public function find($id): ?Model
    {
        return $this->scholarshipRepository->find($id);
    }
}
