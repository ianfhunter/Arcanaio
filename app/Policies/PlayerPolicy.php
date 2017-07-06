<?php

namespace App\Policies;

use App\Player;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlayerPolicy {
	use HandlesAuthorization;

	public function before(User $user) {

	}

	/**
	 * Determine whether the user can view the player.
	 *
	 * @param  App\User  $user
	 * @param  App\Player  $player
	 * @return mixed
	 */
	public function view(User $user, Player $player) {
		if (\Auth::id() == $player->user_id || request()->key == $player->key) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Determine whether the user can create players.
	 *
	 * @param  App\User  $user
	 * @return mixed
	 */
	public function create(User $user) {
		//
	}

	/**
	 * Determine whether the user can update the player.
	 *
	 * @param  App\User  $user
	 * @param  App\Player  $player
	 * @return mixed
	 */
	public function update(User $user, Player $player) {
		return $user->id === $player->user_id;
	}

	/**
	 * Determine whether the user can delete the player.
	 *
	 * @param  App\User  $user
	 * @param  App\Player  $player
	 * @return mixed
	 */
	public function delete(User $user, Player $player) {
		return $user->id === $player->user_id;
	}
}
