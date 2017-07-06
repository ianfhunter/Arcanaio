<?php

namespace App\Policies;

use App\User;
use App\MonsterAbility;
use Illuminate\Auth\Access\HandlesAuthorization;

class MonsterAbilityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the test.
     *
     * @param  App\User  $user
     * @param  App\Test  $test
     * @return mixed
     */
    public function view(User $user, MonsterAbility $ability)
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
    public function update(User $user, MonsterAbility $ability)
    {
        return $user->id === $ability->user_id;
    }

    /**
     * Determine whether the user can delete the test.
     *
     * @param  App\User  $user
     * @param  App\Test  $test
     * @return mixed
     */
    public function delete(User $user, MonsterAbility $ability)
    {
        return $user->id === $ability->user_id;
    }
}
