<?php

namespace App\Repositories\Scholarship;

use App\Models\User\UserInterface;
use Illuminate\Database\Eloquent\Collection;

interface ScholarshipRepositoryInterface
{
    public function allByUser(UserInterface $user): ?Collection;
}
