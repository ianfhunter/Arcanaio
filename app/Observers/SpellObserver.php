<?php

namespace App\Observers;

use App\Spell;
use Illuminate\Support\Facades\Cache;

class SpellObserver {
	/**
	 * Listen to the User created event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function created(Spell $spell) {
		Cache::tags('spells')->flush();
	}

	public function creating(Spell $spell) {
		foreach ($spell->toArray() as $name => $value) {
			if (empty($value)) {
				$spell->{$name} = null;
			}
		}
		return true;
	}

	/**
	 * Listen to the spell deleting event.
	 *
	 * @param  spell  $spell
	 * @return void
	 */
	public function deleted(Spell $spell) {
		Cache::tags('spells')->flush();
		Cache::forget('spells_' . $spell->id);
	}

	public function saving(Spell $spell) {
		foreach ($spell->toArray() as $key => $value) {
			if ($value !== 0) {
				$spell->{$key} = empty($value) ? null : $value;
			}
		}
	}

	/**
	 * Listen to the spell deleting event.
	 *
	 * @param  spell  $spell
	 * @return void
	 */
	public function saved(Spell $spell) {
		Cache::forget('spells_' . $spell->id);
	}
}