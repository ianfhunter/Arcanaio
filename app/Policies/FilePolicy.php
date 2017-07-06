<?php

namespace App\Policies;

use App\File;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy {
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
	public function view(User $user, File $file) {
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
	public function update(User $user, File $file) {
		//
	}

	/**
	 * Determine whether the user can delete the test.
	 *
	 * @param  App\User  $user
	 * @param  App\Test  $test
	 * @return mixed
	 */
	public function delete(User $user, File $file) {
		return $user->id === $file->user_id;
	}
}
