<?php

namespace App\Http\Controllers;

use App\Models\Toast;
use Exception;
use Illuminate\Http\Request;

class ToastLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function isLogin(Request $request){
        if(!$request->ajax()){
            return back();
        }
        $loginState = auth()->user() !=null ? true : false;
        return response()->json(["isLogin" => $loginState]);
    }

    function index(){
        return back();
    }

    // using ajax method
    function store($id, Request $request){
        if(!$request->ajax())return back();
        $error=[];
        $result = null;
        $toast = Toast::find($id);
        $user = auth()->user();
        if($toast==null){
            $error[]="Not found";
            return response()->json(["error" => $error, "result"=>$result]);
        }
        if(!$toast->likedBy($user)){       
            $toast->likes()->create(["user_id" => auth()->user()->id]);
        }else{
            $error[]="Not available";
        }
        $result ="liked";
        return response()->json(["error" => $error, "result" => $result]);
    }

    // using ajax method
    function destroy($id, Request $request){
        if(!$request->ajax())return back();
        $error=[];
        $result = null;
        $toast = Toast::find($id);
        if($toast==null){
            $error[]="Not found";
            return response()->json(["error" => $error, "result"=>$result]);
        }
        $user = auth()->user();
        if($toast->likedBy($user)){ 
            $user->likes()->where("toast_id",$toast->id)->delete();
        }else{
            $error[]="Not available";
        }
        $result = "like";
        return response()->json(["error" => $error, "result" => $result]);
    }
}
