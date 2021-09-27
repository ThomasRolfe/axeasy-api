<?php

namespace App\Services\Earnables;

use App\Exceptions\EarnableNotFound;
use App\Models\Earnable\Earnable;
use App\Repositories\Earnable\EarnableRepositoryInterface;
use App\Services\Earnables\Interfaces\GetsEarnable;

class EarnableService implements GetsEarnable
{
    public function __construct(protected EarnableRepositoryInterface $earnableRepository)
    {
    }

    public function getByLabel(string $label): ?Earnable
    {
        $earnable = $this->earnableRepository->getByLabel($label);

        if (!$earnable) {
            throw new EarnableNotFound();
        }

        return $earnable;
    }
}
