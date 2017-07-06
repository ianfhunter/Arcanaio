<?php

namespace App\Observers;

use App\Like;
use Illuminate\Support\Facades\Cache;

class LikeObserver {
	/**
	 * Listen to the User created event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function created(Like $like) {
		$class = lcfirst(str_plural(class_basename($like->likeable_type)));
		if ($class == 'comments') {
			$class = lcfirst(str_plural(class_basename($like->likeable->commentable_type)));
			Cache::forget($class . '_' . $like->likeable->commentable_id);
			Cache::tags($class)->flush();
		} else {
			Cache::forget($class . '_' . $like->likeable_id);
			Cache::tags($class)->flush();
		}
	}

	/**
	 * Listen to the monster deleting event.
	 *
	 * @param  monster  $monster
	 * @return void
	 */
	public function deleted(Like $like) {
		$class = lcfirst(str_plural(class_basename($like->likeable_type)));
		if ($class == 'comments') {
			$class = lcfirst(str_plural(class_basename($like->likeable->commentable_type)));
			Cache::forget($class . '_' . $like->likeable->commentable_id);
			Cache::tags($class)->flush();
		} else {
			Cache::forget($class . '_' . $like->likeable_id);
			Cache::tags($class)->flush();
		}
	}

	/**
	 * Listen to the monster deleting event.
	 *
	 * @param  monster  $monster
	 * @return void
	 */
	public function saved(Like $like) {
		$class = lcfirst(str_plural(class_basename($like->likeable_type)));
		if ($class == 'comments') {
			$class = lcfirst(str_plural(class_basename($like->likeable->commentable_type)));
			Cache::forget($class . '_' . $like->likeable->commentable_id);
			Cache::tags($class)->flush();
		} else {
			Cache::forget($class . '_' . $like->likeable_id);
			Cache::tags($class)->flush();
		}
	}
}