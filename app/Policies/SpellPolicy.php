<?php

namespace App\Policies;

use App\Spell;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpellPolicy {
	use HandlesAuthorization;

	public function before(User $user) {

	}

	/**
	 * Determine whether the user can view the spell.
	 *
	 * @param  App\User  $user
	 * @param  App\Spell  $spell
	 * @return mixed
	 */
	public function view(User $user, Spell $spell) {
		//
	}

	/**
	 * Determine whether the user can create spells.
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
	public function update(User $user, Spell $spell) {
		return $user->id === $spell->user_id;
	}

	/**
	 * Determine whether the user can delete the spell.
	 *
	 * @param  App\User  $user
	 * @param  App\Spell  $spell
	 * @return mixed
	 */
	public function delete(User $user, Spell $spell) {
		return $user->id === $spell->user_id;
	}
}
