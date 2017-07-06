<?php

namespace App\Observers;

use App\Monster;
use Illuminate\Support\Facades\Cache;

class MonsterObserver {
	public function creating(Monster $monster) {
		foreach ($monster->toArray() as $name => $value) {
			if (empty($value)) {
				$monster->{$name} = null;
			}
		}
		return true;
	}

	/**
	 * Listen to the User created event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function created(Monster $monster) {
		Cache::tags('monsters')->flush();
	}

	/**
	 * Listen to the monster deleting event.
	 *
	 * @param  monster  $monster
	 * @return void
	 */
	public function deleted(Monster $monster) {
		Cache::tags('monsters')->flush();
		Cache::forget('monsters_' . $monster->id);
	}

	/**
	 * Listen to the monster deleting event.
	 *
	 * @param  monster  $monster
	 * @return void
	 */
	public function saved(Monster $monster) {
		Cache::forget('monsters_' . $monster->id);
	}

	public function saving(Monster $monster) {
		foreach ($monster->toArray() as $key => $value) {
			if ($value !== 0) {
				$monster->{$key} = empty($value) ? null : $value;
			}
		}
	}
}