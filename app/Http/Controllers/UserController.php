<?php

namespace App\Http\Controllers;

use App\Models\Toast;
use App\Models\User;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth'])->only(["updateUser","likedToasts"]);
    }

    public function updateUser($id, Request $request){
        $user = User::find($id);
        $this->authorize('update',$user);
        $validator = Validator::make($request->all(),[
            "name" => "required|max:255",
            "phone"=>"required|digits_between:10,11",
            "date" =>"required|date",
            "password" => "max:255",
        ],[
            "required" => ":attribute không thể để trống",
            "digits_between" => ":attribute Chỉ chứa rối đa từ :min - :max ký số",
            "date" => ":attribute không hợp lệ",
            "max" => ":attribute chỉ có thể chứa tối đa :max ký tự"
        ]);

        if(!$validator->fails()){
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->date = $request->date;
            if(strlen($request->password) > 0){
                $user->password = Hash::make($request->password);
            }
            $user->save();
        }
        return response()->json(["error" => $validator->failed()],200, ["Content-Type"=>"json/application"]);
    }

    // lấy tất cả toast của user
    public function index($username,Request $request){
        $error=[];
        $user = User::where("username",$username)->first();
        $view = null;
        $toasts= null;
        if(!$user){
            $error[]="Not Found";
        }else{
            $toasts = $user->toasts()->latest()->with(['user','likes'])->simplePaginate(6);
        }

        if($request->ajax()){
            $view = count($error) > 0 ? view("errors.notfound-text")->render() : view("toast.toasts",["toasts"=>$toasts])->render();
            return response()->json(["error"=>$error,"html" => $view]);
        }

        if(count($error) > 0){
            return view("errors.notfound");
        }
        return view("user.profile",["user"=>$user, 'toasts' => $toasts]);  
    }

    public function showLikedToasts($username, Request $request){
        $error=[];
        $view = null;
        $user = User::where("username",$username)->first();
        $toasts=null;
        if(!$user){
            $error[]="Not Found";
        }else{
            $toasts =  Toast::latest()->with(['user','likes'])->whereHas("likes",function ($like) use ($user) {
                return$like->where("user_id",$user->id);
            })->simplePaginate(6);
        }

        if($request->ajax()){
            $view = count($error) > 0 ? view("errors.notfound-text")->render() : view("toast.toasts",["toasts"=>$toasts])->render();
            return response()->json(["html" => $view,"error"=>$error]);
        }

        if(count($error)>0){
            return view("errors.notfound");
        }
        return view("user.profile",["user"=>$user, 'toasts' => $toasts]);
    }
}
