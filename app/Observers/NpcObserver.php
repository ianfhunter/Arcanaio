<?php

namespace App\Observers;

use App\Npc;
use Illuminate\Support\Facades\Cache;

class npcObserver {
	public function creating(Npc $npc) {
		foreach ($npc->toArray() as $name => $value) {
			if (empty($value)) {
				$npc->{$name} = null;
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
	public function created(Npc $npc) {
		Cache::tags('npcs')->flush();
	}

	/**
	 * Listen to the npc deleting event.
	 *
	 * @param  npc  $npc
	 * @return void
	 */
	public function deleted(Npc $npc) {
		Cache::tags('npcs')->flush();
		Cache::forget('npcs_' . $npc->id);
	}

	/**
	 * Listen to the npc deleting event.
	 *
	 * @param  npc  $npc
	 * @return void
	 */
	public function saved(Npc $npc) {
		Cache::forget('npcs_' . $npc->id);
	}

	public function saving(Npc $npc) {
		foreach ($npc->toArray() as $key => $value) {
			if ($value !== 0) {
				$npc->{$key} = empty($value) ? null : $value;
			}
		}
	}
}