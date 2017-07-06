<?php

namespace App\Policies;

use App\Location;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy {
	use HandlesAuthorization;

	public function before(User $user) {

	}

	/**
	 * Determine whether the user can view the Item.
	 *
	 * @param  App\User  $user
	 * @param  App\Item  $Item
	 * @return mixed
	 */
	public function view(User $user, Location $location) {
		//
	}

	/**
	 * Determine whether the user can create items.
	 *
	 * @param  App\User  $user
	 * @return mixed
	 */
	public function create(User $user) {
		//
	}

	/**
	 * Determine whether the user can update the spell.
	 *
	 * @param  App\User  $user
	 * @param  App\Spell  $spell
	 * @return mixed
	 */
	public function update(User $user, Location $location) {
		return $user->id === $location->user_id;
	}

	/**
	 * Determine whether the user can delete the spell.
	 *
	 * @param  App\User  $user
	 * @param  App\Spell  $spell
	 * @return mixed
	 */
	public function delete(User $user, Location $location) {
		return $user->id === $location->user_id;
	}
}
