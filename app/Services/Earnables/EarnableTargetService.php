<?php

namespace App\Services\Earnables;

use App\Exceptions\InvalidEarnableTargetAmount;
use App\Models\Earnable\EarnableInterface;
use App\Models\EarnableTarget\EarnableTarget;
use App\Models\Scholarship\ScholarshipInterface;
use App\Repositories\EarnableTarget\EarnableTargetRepositoryInterface;
use App\Services\Earnables\Interfaces\CreatesEarnableTarget;
use App\ValueObjects\TimeFrequency\TimeFrequency;

class EarnableTargetService implements CreatesEarnableTarget
{
    public function __construct(protected EarnableTargetRepositoryInterface $earnableTargetRepository)
    {
    }

    public function create(
        ScholarshipInterface $scholarship,
        EarnableInterface $earnable,
        int $amount,
        TimeFrequency $frequency
    ): EarnableTarget {

        if($amount <= 0) {
            throw new InvalidEarnableTargetAmount();
        }

        $this->removeExistingTarget($scholarship, $earnable);

        $earnableTarget = $this->earnableTargetRepository->new([
            'earnable_id' => $earnable->id,
            'amount' => $amount,
            'frequency' => $frequency->getFrequency()
        ]);

        return $scholarship->earnableTargets()->save($earnableTarget);
    }

    private function removeExistingTarget(ScholarshipInterface $scholarship, EarnableInterface $earnable)
    {
        $scholarship->earnableTargets()
            ->where('label', '=', $earnable->label)
            ->delete();
    }
}
