<?php

namespace App\Observers;

use App\File;
use Illuminate\Support\Facades\Cache;

class FileObserver {
	/**
	 * Listen to the User created event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function created(File $file) {
		$class = lcfirst(str_plural(class_basename($file->fileable_type)));
		Cache::forget($class . '_' . $file->fileable_id);
	}

	/**
	 * Listen to the monster deleting event.
	 *
	 * @param  monster  $monster
	 * @return void
	 */
	public function deleted(File $file) {
		$class = lcfirst(str_plural(class_basename($file->fileable_type)));
		Cache::forget($class . '_' . $file->fileable_id);
	}

}