<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'parent_id',
        'user_id',
        'commentable_id',
        'commentable_type',
        'comment',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id');
    }

    static public function recivedComments($toast){
        $sum = $toast->comments->count();
        foreach($toast->comments as $comment){
            $sum+= $comment->replies->count();
        }
        return $sum;
    }
}
