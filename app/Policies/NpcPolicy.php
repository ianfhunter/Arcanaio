<?php

namespace App\Policies;

use App\Npc;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NpcPolicy {
	use HandlesAuthorization;

	public function before(User $user) {

	}

	/**
	 * Determine whether the user can view the test.
	 *
	 * @param  App\User  $user
	 * @param  App\Test  $test
	 * @return mixed
	 */
	public function view(User $user, Npc $npc) {
		//
	}

	/**
	 * Determine whether the user can create tests.
	 *
	 * @param  App\User  $user
	 * @return mixed
	 */
	public function create(User $user) {
		//
	}

	/**
	 * Determine whether the user can update the test.
	 *
	 * @param  App\User  $user
	 * @param  App\Test  $test
	 * @return mixed
	 */
	public function update(User $user, Npc $npc) {
		return $user->id === $npc->user_id;
	}

	/**
	 * Determine whether the user can delete the test.
	 *
	 * @param  App\User  $user
	 * @param  App\Test  $test
	 * @return mixed
	 */
	public function delete(User $user, Npc $npc) {
		return $user->id === $npc->user_id;
	}
}
