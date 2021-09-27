<?php

namespace App\Repositories\Earnable;

use App\Models\Earnable\Earnable;

class EarnableRepository implements EarnableRepositoryInterface
{
    public function getByLabel(string $label): ?Earnable
    {
        return Earnable::where('label', '=', $label)->first();
    }
}
