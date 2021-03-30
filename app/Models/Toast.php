<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toast extends Model
{
    use HasFactory;
    protected $fillable = [
        "content"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function likedBy(User $user){
        return $this->likes->contains("user_id", $user->id);
    }
    
    // sử dụng cách này hoặc dùng Policy cho Toast Model
    public function ownedBy(User $user){
        return $user->id == $this->user_id;
    }
}
