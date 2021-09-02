<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScholarshipRequest;
use App\Http\Resources\ScholarshipCollection;
use App\Http\Resources\ScholarshipResource;
use App\Models\Scholarship;
use App\Repositories\ScholarshipRepository;
use App\Services\Scholarships\ScholarshipService;
use Exception;

class ScholarshipController extends Controller
{
    public function __construct(
        protected ScholarshipRepository $scholarshipRepository,
        protected ScholarshipService $scholarshipService
    ) {
    }

    public function index()
    {
        $this->authorize('viewAny', Scholarship::class);

        $scholarships = $this->scholarshipRepository->all();

        return new ScholarshipCollection($scholarships);
    }

    public function show($id)
    {
        $scholarship = $this->scholarshipRepository->find($id);

        if (!$scholarship) {
            abort(404, 'Scholarship not found');
        }

        $this->authorize('view', $scholarship);

        return ScholarshipResource::make($scholarship);
    }

    public function create(CreateScholarshipRequest $request)
    {
        try {
            $scholarship = $this->scholarshipService->createScholarship($request->validated());
        } catch (Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return ScholarshipResource::make($scholarship);
    }

}
