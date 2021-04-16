<?php

namespace App\Http\Controllers;

use App\Models\Toast;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth'])->only(["updateUser","likedToasts"]);
    }

    public function updateUser($id, Request $request){
        //if(!$request->ajax()) return back();
        $user = User::find($id);
        $this->authorize('update',$user);
        $validator = Validator::make($request->all(),[
            "name" => "required|max:255",
            "phone"=>"required|digits_between:10,11",
            "date" =>"required|date",
            "password" => "max:255",
            "image" => "mimes:jpeg,jpg,png,gif|max:2048"
        ],[
            "name.required" => "Tên không thể để trống",
            "phone.required" => "Số điện thoại không thể để trống",
            "date.required" => "Ngày sinh không thể để trống",
            "phone.digits_between" => "Số điện thoại chỉ có tối đa từ :min - :max số",
            "date.date" => "Định dạng ngày không hợp lệ",
            "name.max" => "Tên chỉ có thể chứa tối đa :max ký tự",
            "password.max" => "Mật khẩu chỉ có thể chứa tối đa :max ký tự",
            "image.mimes" => "Hình ảnh bạn upload không được hộ trợ.",
            "image.max" => "Vui lòng chọn file có kích thước < 2Mb",
        ])->validateWithBag("profile");

            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->date = $request->date;
            if(strlen($request->password) > 0){
                $user->password = Hash::make($request->password);
            }

            if($request->hasFile('image') === true){
                $image = $request->file('image');
                $dt = Carbon::now('Asia/Ho_Chi_Minh');
                $uname = $user->username;
                $extension = $image->extension();
                $filename = $uname.$dt->format("YmdHis").".".$extension;
                $imageStored = $image->storeAs("userimages", $filename, "public");
                if($imageStored!==false && Storage::disk("public")->exists("userimages/".$user->image)){
                    Storage::disk("public")->delete("userimages/".$user->image);
                }
                $user->image = $filename;
            }
            $user->save();
        return back();
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
                return $like->where("user_id",$user->id);
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

    public function followUser($followId, Request $request){
        if(!$request->ajax())return;

        $user = auth()->user();
        $followUser = User::find($followId);
        if($followUser !==null){
            $followUser->followers()->attach($user->id);
            return response()->json(['status'=>'following', "errors"=>null, 'nextAction' => 'unfollow']);
        }

        return response()->json(["errors"=>['Xảy ra lỗi']]);
    }

    public function unFollowUser($unfollowId, Request $request){
        if(!$request->ajax())return;

        $user = auth()->user();
        $unfollowUser = User::find($unfollowId);
        if($unfollowUser !==null){
            $unfollowUser->followers()->detach($user->id);
            return response()->json(['status'=>'follow', "errors"=>null, 'nextAction' => 'follow']);
        }

        return response()->json(["errors"=>['Xảy ra lỗi']]);
    }

    public function searchUser(Request $request){
        $users = User::with(['toasts','likes'])->where("role_id",'1')->where(function($query) use($request){
            $query->where('name','like','%'.$request->username.'%')->orWhere('username','like','%'.$request->username.'%');
        })->get();
        return view('user.search',["users"=>$users, 'key'=>$request->username]);
    }

}
