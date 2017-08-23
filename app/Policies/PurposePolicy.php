<?php

namespace App\Policies;

use App\User;
use App\Purpose;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PurposePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the purpose.
     *
     * @param  \App\User  $user
     * @param  \App\Purpose  $purpose
     * @return mixed
     */
    public function view(User $user, Purpose $purpose)
    {
        //
    }

    /**
     * Determine whether the user can create purposes.
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
     * Determine whether the user can update the purpose.
     *
     * @param  \App\User  $user
     * @param  \App\Purpose  $purpose
     * @return mixed
     */
    public function update(User $user, Purpose $purpose)
    {
        //
        return $user->id === $purpose->user_id;
    }

    /**
     * Determine whether the user can delete the purpose.
     *
     * @param  \App\User  $user
     * @param  \App\Purpose  $purpose
     * @return mixed
     */
    public function delete(User $user, Purpose $purpose)
    {
        //
        return $user->id === $purpose->user_id;
    }
}
