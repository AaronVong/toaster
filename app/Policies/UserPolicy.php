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

    public function update(User $guest, User $user){
        return $guest->id === $user->id;
    }

    public function follow(User $guest, User $user){
        return $guest->id !== $user->id;
    }
}
