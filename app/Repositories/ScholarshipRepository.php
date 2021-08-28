<?php

namespace App\Repositories;

use App\Models\Scholarship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ScholarshipRepository implements EloquentRepositoryInterface
{

    public function create(array $attributes): ?Model
    {
        return Scholarship::create($attributes);
    }

    public function find($id): ?Model
    {
        if (!Auth::user()->company) {
            return null;
        }

        return Auth::user()->company->scholarships->where('id', '=', $id)->first();
    }

    public function all(): Collection
    {
        if (!Auth::user()->company) {
            return collect([]);
        }

        return Auth::user()->company->scholarships;
    }
}
