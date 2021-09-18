<?php

namespace App\Services\Scholarships;

use App\Events\ScholarshipCreated;
use App\Exceptions\UserCompanyNotFoundException;
use App\Models\Scholarship\Scholarship;
use App\Models\User\User;
use App\Models\User\UserInterface;
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

    public function create(UserInterface $user, array $attributes): Model
    {
        if (!$user->company) {
            throw new UserCompanyNotFoundException('User is required to be connected to a company to create a scholarship',
                422);
        }

        $scholarship = $this->scholarshipRepository->create($attributes);

        ScholarshipCreated::dispatch($user->company, $scholarship);

        return $scholarship;
    }

    public function all(): ?Collection
    {
        return $this->scholarshipRepository->allByUser($this->userService->authed());
    }

    public function find($id): ?Model
    {
        return $this->scholarshipRepository->find($id);
    }
}
