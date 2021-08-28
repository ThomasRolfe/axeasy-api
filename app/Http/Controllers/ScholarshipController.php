<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScholarshipCollection;
use App\Http\Resources\ScholarshipResource;
use App\Repositories\ScholarshipRepository;
use Illuminate\Support\Facades\Auth;

class ScholarshipController extends Controller
{

    protected $scholarshipRepository;

    public function __construct(ScholarshipRepository $scholarshipRepository)
    {
        $this->scholarshipRepository = $scholarshipRepository;
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

    public function create()
    {
    }


}
