<?php

namespace App\Repositories\Company;

use App\Models\Company\CompanyInterface;
use App\Repositories\BaseRepository;
use App\Repositories\CreatesModelInterface;
use Illuminate\Database\Eloquent\Model;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface, CreatesModelInterface
{

    public function __construct(CompanyInterface $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes): ?Model
    {
        return $this->model->create($attributes);
    }
}
