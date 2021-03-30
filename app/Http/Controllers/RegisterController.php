<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
        function __construct()
    {
        $this->middleware('guest');
    }

    function index(){
        return view('auth.register');
    }

    function store(Request $req){
        $this->validate($req, [
            "name" => "required|max:255",
            "username"=>"required|max:255|unique:App\Models\User,username",
            "email"=>"required|max:255|email|unique:App\Models\User,email",
            "password"=>"required|confirmed",
            "phone"=>"required|digits_between:10,11",
            "date" =>"required|date",
        ]);
    
        User::create([
            "name"=>$req->name,
            "username"=>$req->username,
            "email"=>$req->email,
            "phone"=>$req->phone,
            "password"=>Hash::make($req->password),
            "date"=>$req->date,
        ]);
        Auth::attempt($req->only('email','password'));
        return redirect()->route('home.index');
    }
}
