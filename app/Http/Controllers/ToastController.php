<?php

namespace App\Http\Controllers;

use App\Models\Toast;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class ToastController extends Controller
{
    function __construct()
    {
        $this->middleware("auth")->only(["store", "destroy"]);
    }

    function index(){
        $toasts = Toast::latest()->with(['user','likes'])->simplePaginate(6);
        if(auth()->user()){
            $followingUsers = auth()->user()->followings()->pluck('user_follows.follow_id');
            if(count($followingUsers) > 0)
                $toasts = Toast::latest()->whereIn("user_id", $followingUsers)->orWhere('user_id', auth()->user()->id)->simplePaginate(6);
        }  
        return view("home",['toasts'=>$toasts]);
    }

    function explore(){
        $toasts = Toast::latest()->with(['user','likes'])->simplePaginate(6);
        return view("home", ["toasts" => $toasts]);
    }
    
    function showToast(Toast $toast){
        return view('toast.showtoast',["toast"=>$toast]);
    }

    function store(Request $request){
        $validator = Validator::make($request->only("content","images"), [
            "content" => "required",
            "images" =>"array|max:5",
            "images.*"=> "mimes:jpeg,jpg,png,gif|max:8192",
        ],[
            "content.required" => "Hãy điền nội dung cho Toast",
            "images.*.mimes" => "Định dạng hình ảnh không được hộ trợ",
            "images.*.max" => "Hình ảnh có kích thước quá lớn",
            "images.max" =>"Tối đa :max hình được phép upload",
        ])->validateWithBag('toast');

        $createdToast = $request->user()->toasts()->create([
            "content"=>$request->content,
        ]);
        if($request->hasFile('images')){
            $files = $request->file('images');
            $dt = Carbon::now('Asia/Ho_Chi_Minh');
            $uid = $request->user()->id;
            $uname = $request->user()->username;
            foreach($files as $key=>$file){
                $extension = $file->extension();
                $filename = $uname.$dt->format("YmdHis").$key.".".$extension;
                $createdToast->toastImages()->create(["user_id" => $uid, "imagename"=> $filename]);
                $file->storeAs("toastimages", $filename, "public");
            }
        }
        return back();  
    }

    function destroy(Toast $toast){
        $this->authorize('delete',$toast);
        $images = $toast->toastImages()->get(["imagename"]);
        foreach($images as $image){
            if(Storage::disk("public")->exists("toastimages/".$image->imagename)){
                Storage::disk("public")->delete("toastimages/".$image->imagename);
            }            
        }
        // $toast->toastImages()->delete();
        // $toast->likes()->delete();
        $toast->delete();
        return redirect()->route('home.index');
    }
}
