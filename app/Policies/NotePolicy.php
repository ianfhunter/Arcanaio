<?php

namespace App\Policies;

use App\User;
use App\Note;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the test.
     *
     * @param  App\User  $user
     * @param  App\Test  $test
     * @return mixed
     */
    public function view(User $user, Note $note)
    {
        //
    }

    /**
     * Determine whether the user can create tests.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the test.
     *
     * @param  App\User  $user
     * @param  App\Test  $test
     * @return mixed
     */
    public function update(User $user, Note $note)
    {
        //
    }

    /**
     * Determine whether the user can delete the test.
     *
     * @param  App\User  $user
     * @param  App\Test  $test
     * @return mixed
     */
    public function delete(User $user, Note $note)
    {
        return $user->id === $note->user_id;
    }
}
