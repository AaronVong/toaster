<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function store(){
        Auth::logout();
        return redirect()->route('login.index');
    }
}
