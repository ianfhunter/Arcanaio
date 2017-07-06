<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;

use App\Events\MonsterCommentCreated;
use App\Events\SpellCommentCreated;
use App\Events\ItemCommentCreated;
use App\Events\NpcCommentCreated;
use App\Events\EncounterCommentCreated;

class CommentController extends Controller
{

    public function comment(Request $request, $type, $id){

	    $type = ucfirst($type);
	    $event_name = 'App\Events\\'.$type.'CommentCreated';

	    $this->validate($request, [
	        'body' => 'required|max:1000',
	    ]);

	    $comment = new Comment;
	    $comment->user_id = \Auth::id();
	    $comment->body = $request->input('body');
	    $comment->commentable_id = $id;
	    $comment->commentable_type = 'App\\'.$type;
	    $comment->save();

	   	event(new $event_name($comment));
        
        return back();
    }

    public function delete($id){
    	$comment = Comment::findOrFail($id);
    	$this->authorize('delete', $comment);
    	$comment->delete();
    	return back();
    }
}
