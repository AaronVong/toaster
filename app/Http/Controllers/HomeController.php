<?php

namespace App\Http\Controllers;

use App\Models\Toast;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class HomeController extends Controller
{
    function index(){
        $toasts = Toast::latest()->with(['user','likes'])->simplePaginate(6);
        return view("home",['toasts'=>$toasts]);
    }

}
