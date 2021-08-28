<?php

namespace App\Services\Scholarships;

use App\Exceptions\UserCompanyNotFoundException;
use App\Models\Scholarship;
use App\Repositories\ScholarshipRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ScholarshipService
{
    public function __construct(protected ScholarshipRepository $scholarshipRepository)
    {
    }

    public function createScholarship(array $attributes): Model
    {
        if(!Auth::user()->company) {
            throw new UserCompanyNotFoundException('User is required to be connected to a company to create a scholarship', 422);
        }

        $scholarship = $this->scholarshipRepository->create($attributes);

        Auth::user()->company->scholarships()->save($scholarship);

        return $scholarship;
    }
}
