<?php

namespace App\Policies;

use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param UserInterface $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(UserInterface $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param UserInterface $user
     * @param CompanyInterface $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserInterface $user, CompanyInterface $company)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param UserInterface $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserInterface $user)
    {
        return $user->company === null
            ? Response::allow()
            : Response::deny('User with a company cannot create a new one');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param UserInterface $user
     * @param CompanyInterface $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserInterface $user, CompanyInterface $company)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param UserInterface $user
     * @param CompanyInterface $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserInterface $user, CompanyInterface $company)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param UserInterface $user
     * @param CompanyInterface $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(UserInterface $user, CompanyInterface $company)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param UserInterface $user
     * @param CompanyInterface $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(UserInterface $user, CompanyInterface $company)
    {
        //
    }
}
