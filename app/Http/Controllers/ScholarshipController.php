<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScholarshipResource;
use Illuminate\Support\Facades\Auth;

class ScholarshipController extends Controller
{
    public function show($id)
    {
        $scholarship = Auth::user()->scholarships->where('id', '=', $id)->first();

        if(!$scholarship) {
            abort(404, 'Scholarship not found');
        }

        return ScholarshipResource::make($scholarship);
    }
}
