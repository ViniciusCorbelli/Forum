<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user) // index
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, Post $model) // show
    {
        return ($user->id == $model->user_id || $user->access == "Administrador" || $user->access == "Moderador");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user) // create e store
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, Post $model) // edit e update
    {
        return ($user->id == $model->user_id || $user->access == "Administrador" || $user->access == "Moderador");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, Post $model)
    {
        return ($user->id == $model->user_id || $user->access == "Administrador" || $user->access == "Moderador");
    }

    public function validate(User $user, Post $model)
    {
        return ($user->access == "Administrador" || $user->access == "Moderador");
    }
}
