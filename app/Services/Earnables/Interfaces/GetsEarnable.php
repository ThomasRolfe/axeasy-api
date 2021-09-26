<?php

namespace App\Services\Earnables\Interfaces;

use App\Models\Earnable\Earnable;

interface GetsEarnable
{
    public function getByLabel(string $name): Earnable;
}
