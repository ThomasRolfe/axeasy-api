<?php

namespace App\Repositories\Scholarship;

use App\Models\Scholarship;
use App\Repositories\BaseRepository;
use App\Repositories\CreatesModelInterface;
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
}
