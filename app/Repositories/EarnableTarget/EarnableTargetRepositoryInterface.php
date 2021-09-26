<?php

namespace App\Repositories\EarnableTarget;

use App\Models\EarnableTarget\EarnableTarget;

interface EarnableTargetRepositoryInterface
{
    public function new(array $attributes): EarnableTarget;
}
