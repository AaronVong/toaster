<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Toast;
use App\Models\User;
use App\Models\ToastImages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function __construct()
    {
        return $this->middleware(["auth","admin"]);
    }

    function index(){
        $toasts = Toast::with(["users", "likes"]);
        $users =    User::all()->where("role_id",'1');
        $images =  ToastImages::all();
        $members = User::where("role_id",'!=','1');
        return view("admin.dashboard" ,["toasts" => $toasts, "users"=>$users, "images" => $images, "members"=> $members]);
    }

    function members(){
        $members = User::where("role_id",'!=','1')->paginate(5);
        return view("admin.members",['members' => $members]);
    }

    function addMember(Request $req){
        if(auth()->user()->role_id == 2){
            $this->validate($req, [
                "name" => "required|max:255",
                "username"=>"required|max:255|unique:App\Models\User,username",
                "email"=>"required|max:255|email|unique:App\Models\User,email",
                "password"=>"required|confirmed",
                "phone"=>"required|digits_between:10,11",
                "date" =>"required|date",
                "role" => "required|numeric"
            ]);
        
            $user = User::create([
                "name"=>$req->name,
                "username"=>$req->username,
                "email"=>$req->email,
                "phone"=>$req->phone,
                "password"=>Hash::make($req->password),
                "date"=>$req->date,
                "role_id" => $req->role,
            ]);
        }
        else return back();
        return back()->with("isAdded", "Thêm mới thành viên ". $req->name ." thành công");
    }

    function notReady(){
        return view("admin.notready");
    }
}
