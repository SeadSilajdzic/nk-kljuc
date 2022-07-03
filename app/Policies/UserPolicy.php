<?php

namespace App\Policies;

use App\Models\Dashboard\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin == 1;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        if ($user->isAdmin) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function update(User $user, User $model)
    {
        if ($user->isAdmin || $user->id === $model->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function delete(User $user, User $model)
    {
        if ($user->isAdmin && ($model->id !== 1 || $model->id !== $user->id)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function restore(User $user, User $model)
    {
        if($user->isAdmin && ($model->id !== $user->id || $model->id !== 1) ) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function forceDelete(User $user, User $model)
    {
        if ($user->isAdmin && ($model->id !== 1 || $model->id !== $user->id)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can check the list of the members.
     *
     * @param User $user
     * @return bool
     */
    public function checkMembers(User $user)
    {
        if ($user->isAdmin) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can check the list archived users.
     *
     * @param User $user
     * @return bool
     */
    public function archived(User $user) {
        if($user->isAdmin) {
            return true;
        }

        return false;
    }
}
