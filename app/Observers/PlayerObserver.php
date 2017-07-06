<?php

namespace App\Observers;

use App\Player;
use Illuminate\Support\Facades\Cache;

class PlayerObserver {
	public function creating(Player $player) {
		foreach ($player->toArray() as $name => $value) {
			if (empty($value)) {
				$player->{$name} = null;
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
	public function created(Player $player) {
		Cache::tags('players')->flush();
	}

	/**
	 * Listen to the player deleting event.
	 *
	 * @param  player  $player
	 * @return void
	 */
	public function deleted(Player $player) {
		Cache::tags('players')->flush();
		Cache::forget('players_' . $player->id);
	}

	/**
	 * Listen to the player deleting event.
	 *
	 * @param  player  $player
	 * @return void
	 */
	public function saved(Player $player) {
		Cache::forget('players_' . $player->id);
	}

	public function saving(Player $player) {
		foreach ($player->toArray() as $key => $value) {
			if ($value !== 0) {
				$player->{$key} = empty($value) ? null : $value;
			}
		}
	}
}