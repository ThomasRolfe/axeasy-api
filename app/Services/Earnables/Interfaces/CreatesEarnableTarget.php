<?php

namespace App\Services\Earnables\Interfaces;

use App\Models\Earnable\EarnableInterface;
use App\Models\EarnableTarget\EarnableTarget;
use App\Models\Scholarship\ScholarshipInterface;
use App\ValueObjects\TimeFrequency\TimeFrequency;

interface CreatesEarnableTarget
{
    public function create(
        ScholarshipInterface $scholarship,
        EarnableInterface $earnable,
        int $amount,
        TimeFrequency $frequency
    ): EarnableTarget;
}
