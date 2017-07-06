<?php

namespace App\Observers;

use App\Comment;
use Illuminate\Support\Facades\Cache;

class CommentObserver {
	/**
	 * Listen to the User created event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function created(Comment $comment) {
		$class = lcfirst(str_plural(class_basename($comment->commentable_type)));
		Cache::forget($class . '_' . $comment->commentable_id);
	}

	/**
	 * Listen to the monster deleting event.
	 *
	 * @param  monster  $monster
	 * @return void
	 */
	public function deleted(Comment $comment) {
		$class = lcfirst(str_plural(class_basename($comment->commentable_type)));
		Cache::forget($class . '_' . $comment->commentable_id);
	}

}