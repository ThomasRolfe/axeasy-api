<?php

namespace App\Repositories\Scholarship;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Collection;

interface ScholarshipRepositoryInterface
{
    public function allAuthed(User $user): ?Collection;
}
