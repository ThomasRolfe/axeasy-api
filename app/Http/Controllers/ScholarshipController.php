<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScholarshipRequest;
use App\Http\Resources\ScholarshipCollection;
use App\Http\Resources\ScholarshipResource;
use App\Models\Scholarship\Scholarship;
use App\Services\Scholarships\ScholarshipServiceInterface;
use App\Services\Users\UserServiceInterface;
use Exception;

class ScholarshipController extends Controller
{
    public function __construct(
        protected ScholarshipServiceInterface $scholarshipService,
        protected UserServiceInterface $userService
    ) {
    }

    public function index()
    {
        $this->authorize('viewAny', Scholarship::class);

        $scholarships = $this->scholarshipService->allByUser();

        return new ScholarshipCollection($scholarships);
    }

    public function show($id)
    {
        $scholarship = $this->scholarshipService->find($id);

        if (!$scholarship) {
            abort(404, 'Scholarship not found');
        }

        $this->authorize('view', $scholarship);

        return ScholarshipResource::make($scholarship);
    }

    public function create(CreateScholarshipRequest $request)
    {
        $this->authorize('create', Scholarship::class);

        $currentUser = $this->userService->authed();

        $scholarship = $this->scholarshipService->create($currentUser->company, $request->validated());

        return ScholarshipResource::make($scholarship);
    }

}
