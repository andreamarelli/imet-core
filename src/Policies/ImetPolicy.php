<?php

namespace AndreaMarelli\ImetCore\Policies;

use AndreaMarelli\ImetCore\Models\Role;
use AndreaMarelli\ImetCore\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class ImetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can: INDEX
     *
     * @param \AndreaMarelli\ImetCore\Models\User $user
     * @param $model
     * @return bool
     */
    public function viewAny(User $user, $model = null): bool
    {
        return User::isAdmin($user)
            || Role::isAuthorized($user);
    }

    /**
     * Determine whether the user can: VIEW
     *
     * @param \AndreaMarelli\ImetCore\Models\User $user
     * @param $model
     * @return bool
     */
    public function view(User $user, $model = null): bool
    {
        return User::isAdmin($user)
            || Role::isAuthorized($user);
    }

    /**
     * Determine whether the user can: CREATE
     *
     * @param \AndreaMarelli\ImetCore\Models\User $user
     * @param $model
     * @return bool
     */
    public function create(User $user, $model = null): bool
    {
        return User::isAdmin($user)
            || Role::isEncoder($user);
    }

    /**
     * Determine whether the user can: EDIT
     *
     * @param \AndreaMarelli\ImetCore\Models\User $user
     * @param $model
     * @return bool
     */
    public function update(User $user, $model = null): bool
    {
        return User::isAdmin($user)
            || Role::isEncoder($user);
    }

    /**
     * Determine whether the user can: DELETE
     *
     * @param \AndreaMarelli\ImetCore\Models\User $user
     * @param $model
     * @return bool
     */
    public function destroy(User $user, $model = null): bool
    {
        return User::isAdmin($user)
            || Role::isEncoder($user);
    }


}
