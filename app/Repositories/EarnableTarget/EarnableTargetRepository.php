<?php

namespace App\Repositories\EarnableTarget;

use App\Models\EarnableTarget\EarnableTarget;

class EarnableTargetRepository implements EarnableTargetRepositoryInterface
{

    public function new(array $attributes): EarnableTarget
    {
        return new EarnableTarget($attributes);
    }
}
