<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VCard;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
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

    public function view(User $user, VCard $vCard)
    {
        return $user->user_type == "A" || $user->id == $vCard->phone_number;
    }

    public function create(User $user, VCard $vCard)
    {
        return $user->id == $vCard->phone_number;
    }

    public function createAdmin(User $user)
    {
        return $user->user_type == "A";
    }

    public function update(User $user, VCard $vCard)
    {
        return $user->id == $vCard->phone_number;
    }
    public function delete(User $user){
        return $user->user_type == "A";
    }
}
