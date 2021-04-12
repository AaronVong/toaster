<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone',
        'date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Toasts(){
        return $this->hasMany(Toast::class);
    }

    // like mà user thực hiện
    public function likes(){
        return $this->hasMany(Like::class);
    }

    // like mà user nhận được ->count() để đếm
    public function recivedLikes(){
        return $this->hasManyThrough(Like::class, Toast::class);
    }

    public function toastImages(){
        return $this->hasMany(ToastImages::class);
    }

    public function uploadedImages(){
        return $this->hasManyThrough(Toast::class, ToastImages::class);
    }

    public function followings(){
        return $this->belongsToMany(User::class, 'user_follows','user_id','follow_id');
    }

    public function followers(){
        return $this->belongsToMany(User::class, 'user_follows','follow_id','user_id');
    }

    public function followed($id){
        $followUser = $this->followings()->where('follow_id',$id)->first();
        return $followUser !== null ? true : false;
    }
}
