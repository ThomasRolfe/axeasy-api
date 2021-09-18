<?php

namespace App\Policies;

use App\Models\Scholarship\Scholarship;
use App\Models\Scholarship\ScholarshipInterface;
use App\Models\User\User;
use App\Models\User\UserInterface;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ScholarshipPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        if(!$user->company) {
            return false;
        }

        return true;
    }

    public function view(UserInterface $user, ScholarshipInterface $scholarship)
    {
        if(!$user->company) {
            return false;
        }

        return $user->company->scholarships->contains($scholarship);
    }

    public function create(UserInterface $user)
    {
        return $user->company !== null
            ? Response::allow()
            : Response::deny('A connected company is required to create a scholarship');
    }

    public function update(UserInterface $user, ScholarshipInterface $scholarship)
    {
        //
    }

    public function delete(UserInterface $user, ScholarshipInterface $scholarship)
    {
        //
    }

    public function restore(UserInterface $user, ScholarshipInterface $scholarship)
    {
        //
    }

    public function forceDelete(UserInterface $user, ScholarshipInterface $scholarship)
    {
        //
    }
}
