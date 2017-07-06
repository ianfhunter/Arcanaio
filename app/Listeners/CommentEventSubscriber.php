<?php

namespace App\Listeners;

use App\Feed;
use App\Comment;
use App\User;
use App\Events\CommentCreated;
use App\Events\CommentCommentCreated;
use App\Events\CommentLikeCreated;
use App\Notifications\CommentLiked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentEventSubscriber
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function onCommentLike($event)
    {
        $comment = Comment::findOrFail($event->like->likeable_id);

        if($event->like->user_id != $comment->user_id){
            $user = User::findOrFail($comment->user_id);
            $user->notify(new CommentLiked($comment, $event->like->user));
        }

        if($comment->commentable_type == 'App\Blog'){
            $data = array('id' => $comment->id,'body' => $comment->body,'commented_object_id' => $comment->commentable->slug, 'commented_object_name' => $comment->commentable->title, 'user_name' => $event->like->user->name, 'commented_object_type' => $comment->commentable_type, 'user_id' => $event->like->user_id, 'avatar' => $event->like->user->avatar);
        }else{
            $data = array('id' => $comment->id,'body' => $comment->body,'commented_object_id' => $comment->commentable_id, 'commented_object_name' => $comment->commentable->name, 'user_name' => $event->like->user->name, 'commented_object_type' => $comment->commentable_type, 'user_id' => $event->like->user_id, 'avatar' => $event->like->user->avatar);
        }



        $feed = new Feed;
        $feed->user_id = $event->like->user_id;
        $feed->type = 'comment_like';
        $feed->data = $data;
        $feed->save();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\CommentLikeCreated',
            'App\Listeners\CommentEventSubscriber@onCommentLike'
        );
    }

}
