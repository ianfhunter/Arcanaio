<?php

namespace App\Policies;

use App\Monster;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MonsterPolicy {
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
	public function view(User $user, Monster $monster) {

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
	public function update(User $user, Monster $monster) {
		return $user->id === $monster->user_id;
	}

	/**
	 * Determine whether the user can delete the test.
	 *
	 * @param  App\User  $user
	 * @param  App\Test  $test
	 * @return mixed
	 */
	public function delete(User $user, Monster $monster) {
		return $user->id === $monster->user_id;
	}
}
