<?php

namespace App\Policies;

use App\Models\Scholarship\Scholarship;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ScholarshipPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if(!$user->company) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User\User $user
     * @param \App\Models\Scholarship\Scholarship $scholarship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Scholarship $scholarship)
    {
        if(!$user->company) {
            return false;
        }

        return $user->company->scholarships->contains($scholarship);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User\User\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->company !== null
            ? Response::allow()
            : Response::deny('A connected company is required to create a scholarship');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User\User $user
     * @param \App\Models\Scholarship\Scholarship $scholarship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Scholarship $scholarship)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User\User $user
     * @param \App\Models\Scholarship\Scholarship $scholarship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Scholarship $scholarship)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User\User $user
     * @param \App\Models\Scholarship\Scholarship $scholarship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Scholarship $scholarship)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User\User $user
     * @param \App\Models\Scholarship\Scholarship $scholarship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Scholarship $scholarship)
    {
        //
    }
}
