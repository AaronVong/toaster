<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserToastController extends Controller
{
    public function index(User $user){
        // eager loading
        $userToasts = $user->toasts()->latest()->with(['user','likes'])->simplePaginate(6);
        return view("user.profile",["user"=>$user, 'toasts' => $userToasts]);
    }
}
