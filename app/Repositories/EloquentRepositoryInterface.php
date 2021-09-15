<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface EloquentRepositoryInterface
{
    public function find($id): ?Model;

    public function all(): Collection;
}
