<?php

namespace AndreaMarelli\ImetCore\Policies;

use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Auth\Access\HandlesAuthorization;
use \ImetUser as User;


class ImetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can INDEX
     * Every role can access the index route but the list will be filtered accordingly
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can UPDATE
     *
     * @param User $user
     * @param $form
     * @return bool
     */
    public function edit(User $user, $form = null): bool
    {
//        dd(Role::hasAnyRole($user));
        if(is_null($form)){
            return Role::hasAnyRole($user);
        }
    }

    /**
     * Determine whether the user can UPDATE
     *
     * @param User $user
     * @param $form
     * @return bool
     */
    public function update(User $user, $form = null): bool
    {
        return $this->edit($user, $form);
    }

    /**
     * Determine whether the user can UPDATE
     *
     * @param User $user
     * @param $form
     * @return bool
     */
    public function view(User $user, $form = null): bool
    {
        return true;
    }

}
