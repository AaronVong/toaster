<?php

namespace App\Http\Controllers;

use App\Models\Toast;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ToastController extends Controller
{
    function __construct()
    {
        $this->middleware("auth")->only(["store", "destroy"]);
    }

    function index(){
        return back();
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
        $images = $toast->toastImages()->get(["fname"]);
        foreach($images as $image){
            Storage::disk("public")->delete("postimages/".$image->fname);
        }
        $toast->toastImages()->delete();
        $toast->likes()->delete();
        $toast->delete();
        return redirect()->route('home.index');
    }
}
