<?php

namespace App\Policies;

use App\Models\Toast;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ToastPolicy
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

    public function delete(User $user, Toast $toast){
        return $user->id === $toast->user_id;
    }
}
