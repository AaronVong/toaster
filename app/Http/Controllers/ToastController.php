<?php

namespace App\Http\Controllers;

use App\Models\Toast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ToastController extends Controller
{
    function __construct()
    {
        $this->middleware("auth");
    }

    function index(){
        return back();
    }
    function showToast(Toast $toast){
        return view('toast.showtoast',["toast"=>$toast]);
    }

    function store(Request $req){
        $this->validate($req,[
            "content"=>"required|max:255|min:1"
        ]);

        $req->user()->toasts()->create([
            "content"=>$req->content,
        ]);
        return back();
    }

    function destroy(Toast $toast){
        $this->authorize('delete',$toast);
        $toast->delete();
        return redirect()->route('home.index');
    }
}
