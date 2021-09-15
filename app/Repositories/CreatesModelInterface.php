<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface CreatesModelInterface
{
    public function create(array $attributes): ?Model;
}
