<?php

namespace App\Repositories\Scholarship;

use App\Models\Scholarship\Scholarship;
use App\Models\User\User;
use App\Repositories\BaseRepository;
use App\Repositories\CreatesModelInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ScholarshipRepository extends BaseRepository implements ScholarshipRepositoryInterface, CreatesModelInterface
{
    public function __construct(Scholarship $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes): ?Model
    {
        return Scholarship::create($attributes);
    }

    public function allAuthed(User $user): Collection
    {
        return $user->company->scholarships;
    }

    public function all(): Collection
    {
        return Scholarship::all();
    }
}
