<?php

namespace App\Policies;

use App\Models\Dashboard\Tag\Tag;
use App\Models\Dashboard\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TagPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        if($user->isAdmin) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        if($user->isAdmin) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Tag $tag
     * @return Response|bool
     */
    public function update(User $user, Tag $tag)
    {
        if($user->isAdmin) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Tag $tag
     * @return Response|bool
     */
    public function delete(User $user, Tag $tag)
    {
        if($user->isAdmin) {
            return true;
        }

        return false;
    }
}
