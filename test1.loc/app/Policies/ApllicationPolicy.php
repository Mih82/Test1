<?php

namespace App\Policies;

use App\User;
use App\Apllication;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApllicationPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any apllications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the apllication.
     *
     * @param  \App\User  $user
     * @param  \App\Apllication  $apllication
     * @return mixed
     */
    public function view(User $user, Apllication $apllication)
    {
        //
    }

    /**
     * Determine whether the user can create apllications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the apllication.
     *
     * @param  \App\User  $user
     * @param  \App\Apllication  $apllication
     * @return mixed
     */
    public function update(User $user, Apllication $apllication)
    {
        //
    }

    /**
     * Determine whether the user can delete the apllication.
     *
     * @param  \App\User  $user
     * @param  \App\Apllication  $apllication
     * @return mixed
     */
	public function delete(User $user){
		return $user->canDo('moderator_delete');
	}

    /**
     * Determine whether the user can restore the apllication.
     *
     * @param  \App\User  $user
     * @param  \App\Apllication  $apllication
     * @return mixed
     */
    public function restore(User $user, Apllication $apllication)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the apllication.
     *
     * @param  \App\User  $user
     * @param  \App\Apllication  $apllication
     * @return mixed
     */
    public function forceDelete(User $user, Apllication $apllication)
    {
        //
    }
}
