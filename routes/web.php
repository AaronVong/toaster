<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ToastController;
use App\Http\Controllers\ToastLikeController;
use App\Http\Controllers\UserController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/',[HomeController::class,'index'])->name('home.index');
// Route::get('/home',[HomeController::class,'index']);



Route::get('/login',[LoginController::class,"index"])->name('login.index');
Route::get("/login/check",[ToastLikeController::class,"isLogin"])->name('login.check');
Route::post('/login',[LoginController::class,"store"])->name("login.create");

Route::get('/register',[RegisterController::class,"index"])->name('register.index');
Route::post('/register',[RegisterController::class,"store"])->name("register.create");

Route::post("/logout",[LogoutController::class,"store"])->name('logout.index');

Route::get('/',[ToastController::class,'index'])->name('home.index');
Route::get('/home',[ToastController::class,'index'])->name('home.index');
Route::get('/explore',[ToastController::class,'explore'])->name("home.explore");
Route::get('/toast/{toast}',[ToastController::class,'showToast'])->name("toast.show");
Route::post("/toast",[ToastController::class,'store'])->name("toast.create");
Route::delete("/toast/{toast}/delete", [ToastController::class,"destroy"])->name("toast.delete");
Route::put("/toast/{toast:id}}/update",[ToastController::class,"update"])->name("toast.update");

Route::get("/toastlike/{toast:id}",[ToastLikeController::class,"index"])->name("like.index");
Route::post("/toastlike/{toast:id}", [ToastLikeController::class, "store"])->name("like.create");
Route::delete("/toastlike/{toast:id}", [ToastLikeController::class, "destroy"])->name("like.destroy");

Route::get("/user/{user:username}/profile",[UserController::class,"index"])->name("user.show");
Route::put("/user/{user}/update",[UserController::class,'updateUser'])->name("user.update");
Route::get("/user/{user:username}/likedtoasts",[UserController::class,'showLikedToasts'])->name('user.show.likedtoasts');
Route::get("/user/search",[UserController::class,"searchUser"])->name('user.search');

Route::post("/user/follow/{user:id}",[UserController::class,"followUser"]);
Route::delete("/user/follow/{user:id}",[UserController::class,"unFollowUser"]);

Route::get("/notready",function(){
    return view("errors.notready");
})->name("error.notready");

Route::post("/comment",[CommentController::class, 'store'])->name('comment.store');
Route::post("/reply", [CommentController::class, 'replyStore'])->name('comment.reply');
Route::delete("/comment/{comment}/delete",[CommentController::class, "destroy"])->name("comment.destroy");
