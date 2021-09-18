<?php

namespace App\Repositories\Scholarship;

use App\Models\Company\CompanyInterface;
use App\Models\Scholarship\ScholarshipInterface;
use App\Models\User\UserInterface;
use App\Repositories\BaseRepository;
use App\Repositories\CreatesModelInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ScholarshipRepository extends BaseRepository implements ScholarshipRepositoryInterface, CreatesModelInterface
{
    public function __construct(ScholarshipInterface $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes): ?Model
    {
        return $this->model::create($attributes);
    }

    public function allByUser(UserInterface $user): Collection
    {
        return $user->company->scholarships;
    }

    public function allByCompany(CompanyInterface $company): Collection
    {
        return $company->scholarships;
    }
}
