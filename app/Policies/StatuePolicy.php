<?php

namespace App\Policies;

use App\User;
use App\Statue;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class StatuePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the statue.
     *
     * @param  \App\User  $user
     * @param  \App\Statue  $statue
     * @return mixed
     */
    public function view(User $user, Statue $statue)
    {
        //
    }

    /**
     * Determine whether the user can create statues.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->id === Auth::id();
    }

    /**
     * Determine whether the user can update the statue.
     *
     * @param  \App\User  $user
     * @param  \App\Statue  $statue
     * @return mixed
     */
    public function update(User $user, Statue $statue)
    {
        //
        return $user->id === $statue->user_id;
    }

    /**
     * Determine whether the user can delete the statue.
     *
     * @param  \App\User  $user
     * @param  \App\Statue  $statue
     * @return mixed
     */
    public function delete(User $user, Statue $statue)
    {
        //
        return $user->id === $statue->user_id;
    }
}
