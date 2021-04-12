<?php

namespace App\Http\Controllers;

use App\Models\Toast;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class HomeController extends Controller
{
    function index(){
        return route('user.profile', auth()->user());
    }

}
