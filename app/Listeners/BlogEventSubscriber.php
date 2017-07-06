<?php

namespace App\Listeners;

use App\Feed;
use App\Blog;
use App\User;
use App\Events\BlogCommentCreated;
use App\Events\BlogLikeCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BlogEventSubscriber
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

    public function onBlogComment($event)
    {
        $blog = Blog::findOrFail($event->comment->commentable_id);

        if($event->comment->user_id != $blog->user_id){
            $user = User::findOrFail($blog->user_id);
            $user->notify(new BlogCommented($blog, $event->comment->user));
        }

        $data = array('id' => $blog->slug, 'name' => $blog->title, 'user_name' => $event->comment->user->name, 'user_id' => $event->comment->user_id, 'body' => $event->comment->body);

        $feed = new Feed;
        $feed->user_id = $event->comment->user_id;
        $feed->type = 'blog_comment';
        $feed->data = $data;
        $feed->save();
    }

    public function onBlogLike($event)
    {
        $blog = Blog::findOrFail($event->like->likeable_id);

        if($event->like->user_id != $blog->user_id){
            $user = User::findOrFail($blog->user_id);
            $user->notify(new BlogLiked($blog, $event->like->user));
        }

        $data = array('id' => $blog->slug, 'name' => $blog->title, 'user_name' => $event->like->user->name, 'user_id' => $event->like->user_id);

        $feed = new Feed;
        $feed->user_id = $event->like->user_id;
        $feed->type = 'blog_like';
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
            'App\Events\BlogCommentCreated',
            'App\Listeners\BlogEventSubscriber@onBlogComment'
        );
        $events->listen(
            'App\Events\BlogLikeCreated',
            'App\Listeners\BlogEventSubscriber@onBlogLike'
        );
    }

}
