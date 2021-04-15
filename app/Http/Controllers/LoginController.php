<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function __construct()
    {
        $this->middleware('guest');
    }

    function index(){
        return view('auth.login');
    }

    function store(Request $req){
        $this->validate($req,[
            "email"=>"required|max:255|email",
            "password"=>"required|max:255",
        ]);
        
        if(!Auth::attempt($req->only('email','password'))){
            return back()->with("loginStatus","Mật khẩu hoặc email không đúng");
        }

        if(Auth::user()->role_id == 1){
            return redirect()->route("home.index");
        }
        else{
            return redirect()->route("admin.dashboard");
        }
    }
}
