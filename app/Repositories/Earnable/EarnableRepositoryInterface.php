<?php

namespace App\Repositories\Earnable;

use App\Models\Earnable\Earnable;

interface EarnableRepositoryInterface
{
    public function getByLabel(string $label): Earnable;
}
