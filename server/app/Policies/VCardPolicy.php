<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VCard;
use Illuminate\Auth\Access\HandlesAuthorization;

class VCardPolicy
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

    public function view(User $user, VCard $model)
    {
        return $user->user_type == "A" || $user->id == $model->phone_number;
    }
    public function update(User $user, VCard $model)
    {
        return $user->user_type == "A" || $user->id == $model->phone_number;
    }

    public function delete(User $user){
        return $user->user_type == "A";
    }
}
