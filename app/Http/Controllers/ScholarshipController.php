<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScholarshipRequest;
use App\Http\Resources\ScholarshipCollection;
use App\Http\Resources\ScholarshipResource;
use App\Models\Scholarship\Scholarship;
use App\Services\Scholarships\Interfaces\CreatesScholarship;
use App\Services\Scholarships\Interfaces\FindsScholarship;
use App\Services\Scholarships\Interfaces\GetsAllScholarships;
use App\Services\Users\Interfaces\GetsAuthedUser;

class ScholarshipController extends Controller
{
    public function __construct(
        protected GetsAuthedUser $userService
    ) {
    }

    public function index(GetsAllScholarships $scholarshipService)
    {
        $this->authorize('viewAny', Scholarship::class);

        $user = $this->userService->authed();
        $scholarships = $scholarshipService->allByUser($user);

        return new ScholarshipCollection($scholarships);
    }

    public function show($id, FindsScholarship $scholarshipService)
    {
        $scholarship = $scholarshipService->find($id);

        if (!$scholarship) {
            abort(404, 'Scholarship not found');
        }

        $this->authorize('view', $scholarship);

        return ScholarshipResource::make($scholarship);
    }

    public function create(CreateScholarshipRequest $request, CreatesScholarship $scholarshipService)
    {
        $scholarship = $scholarshipService->create(
            $this->userService->authed()->company,
            $request->validated()
        );

        return ScholarshipResource::make($scholarship);
    }

}
