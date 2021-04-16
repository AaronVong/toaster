<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Toast;

class CommentController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    function store(Request $request){
        $this->validate($request, [
            "comment" => "required|max:255"
        ]);
        
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->user()->associate($request->user());
        $toast = Toast::find($request->toast_id);
        $toast->comments()->save($comment);
        return back();
    }

    function destroy(Comment $comment, Request $request){
        $this->authorize("delete", $comment);
        $comment->delete();
        return back();
    }

    function replyStore(Request $request){
        $this->validate($request, [
            "comment" => "required|max:255"
        ]);
        $reply = new Comment;
        $reply->comment = $request->get('comment');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $toast = Toast::find($request->get('toast_id'));
        $toast->comments()->save($reply);
        return back();
    }
}
