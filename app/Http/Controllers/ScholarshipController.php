<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScholarshipRequest;
use App\Http\Resources\ScholarshipCollection;
use App\Http\Resources\ScholarshipResource;
use App\Repositories\ScholarshipRepository;
use App\Services\Scholarships\ScholarshipService;
use Exception;
use Illuminate\Support\Facades\Auth;

class ScholarshipController extends Controller
{

    protected $scholarshipRepository;
    protected $scholarshipService;

    public function __construct(ScholarshipRepository $scholarshipRepository, ScholarshipService $scholarshipService)
    {
        $this->scholarshipRepository = $scholarshipRepository;
        $this->scholarshipService = $scholarshipService;
    }

    public function index()
    {
        $scholarships = $this->scholarshipRepository->all();

        return new ScholarshipCollection($scholarships);
    }

    public function show($id)
    {
        $scholarship = $this->scholarshipRepository->find($id);

        if (!$scholarship) {
            abort(404, 'Scholarship not found');
        }

        return ScholarshipResource::make($scholarship);
    }

    public function create(CreateScholarshipRequest $request)
    {
        try {
            $scholarship = $this->scholarshipService->createScholarship($request->validated());
        } catch(Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return ScholarshipResource::make($scholarship);
    }


}
