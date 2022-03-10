<?php

namespace App\Policies;

use App\Models\StatusModel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusesModelsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewTheirs(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StatusModel $computer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, StatusModel $statusModel)
    {
        return $user->is($statusModel->user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StatusModel  $computer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, StatusModel $statusModel)
    {
        return $user->is($statusModel->user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StatusModel $statusModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, StatusModel $statusModel)
    {
        return $user->is($statusModel->user);
    }
}
