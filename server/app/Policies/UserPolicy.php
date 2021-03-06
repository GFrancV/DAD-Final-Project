<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user)
    {
        return $user->user_type == "A";
    }

    public function view(User $user, User $model)
    {
        return $user->user_type == "A" || $user->id == $model->id;
    }
    public function update(User $user, User $model)
    {
        return $user->user_type == "A" || $user->id == $model->id;
    }

    public function delete(User $user)
    {
        return $user->user_type == "A";
    }
}
