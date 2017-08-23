<?php

namespace App\Policies;

use App\Eloquent\User;
use App\Eloquent\Idol;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class IdolPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the idol.
     *
     * @param  \App\User  $user
     * @param  \App\Idol  $idol
     * @return mixed
     */
    public function view(User $user, Idol $idol)
    {
        //
    }

    /**
     * Determine whether the user can create idols.
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
     * Determine whether the user can update the idol.
     *
     * @param  \App\User  $user
     * @param  \App\Idol  $idol
     * @return mixed
     */
    public function update(User $user, Idol $idol)
    {
        //
        return $user->id === $idol->user_id;
    }

    /**
     * Determine whether the user can delete the idol.
     *
     * @param  \App\User  $user
     * @param  \App\Idol  $idol
     * @return mixed
     */
    public function delete(User $user, Idol $idol)
    {
        //
        return $user->id === $idol->user_id;
    }
}
