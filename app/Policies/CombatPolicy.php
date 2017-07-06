<?php

namespace App\Policies;

use App\User;
use App\Combat;
use Illuminate\Auth\Access\HandlesAuthorization;

class CombatPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the combat.
     *
     * @param  App\User  $user
     * @param  App\Combat  $combat
     * @return mixed
     */
    public function view(User $user, Combat $combat)
    {
        return $user->id === $combat->user_id;
    }

    /**
     * Determine whether the user can create combats.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the combat.
     *
     * @param  App\User  $user
     * @param  App\Combat  $combat
     * @return mixed
     */
    public function update(User $user, Combat $combat)
    {
        return $user->id === $combat->user_id;
    }

    /**
     * Determine whether the user can delete the combat.
     *
     * @param  App\User  $user
     * @param  App\Combat  $combat
     * @return mixed
     */
    public function delete(User $user, Combat $combat)
    {
        return $user->id === $combat->user_id;
    }
}
