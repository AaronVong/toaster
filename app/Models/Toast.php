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

    public function toastImages(){
        return $this->hasMany(ToastImages::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    static public function receivedComments(Toast $toast){
        $sum = $toast->comments->count();
        foreach($toast->comments as $comment){
            $sum+= $comment->replies->count();
        }
        return $sum;
    }
}
