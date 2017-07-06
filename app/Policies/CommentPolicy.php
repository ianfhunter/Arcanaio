<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy {
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
	public function view(User $user, Comment $comment) {
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
	public function update(User $user, Comment $comment) {
		//
	}

	/**
	 * Determine whether the user can delete the test.
	 *
	 * @param  App\User  $user
	 * @param  App\Test  $test
	 * @return mixed
	 */
	public function delete(User $user, Comment $comment) {
		return $user->id === $comment->user_id;
	}
}
