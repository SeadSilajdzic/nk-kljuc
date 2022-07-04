<?php

namespace App\Policies;

use App\Models\Dashboard\Post\Post;
use App\Models\Dashboard\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
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
     * @param Post $post
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        if($user->isAdmin || $user->id == $post->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Post $post
     * @return Response|bool
     */
    public function delete(User $user, Post $post)
    {
        if($user->isAdmin || $user->id == $post->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Post $post
     * @return Response|bool
     */
    public function restore(User $user, Post $post)
    {
        if($user->isAdmin || $user->id == $post->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Post $post
     * @return Response|bool
     */
    public function forceDelete(User $user, Post $post)
    {
        if($user->isAdmin || $user->id == $post->user_id) {
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
