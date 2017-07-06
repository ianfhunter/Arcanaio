<?php

namespace App\Observers;

use App\Note;
use Illuminate\Support\Facades\Cache;

class NoteObserver {
	/**
	 * Listen to the User created event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function created(Note $note) {
		$class = lcfirst(str_plural(class_basename($note->noteable_type)));
		Cache::forget($class . '_' . $note->noteable_id);
	}

	/**
	 * Listen to the monster deleting event.
	 *
	 * @param  monster  $monster
	 * @return void
	 */
	public function deleted(Note $note) {
		$class = lcfirst(str_plural(class_basename($note->noteable_type)));
		Cache::forget($class . '_' . $note->noteable_id);
	}

}