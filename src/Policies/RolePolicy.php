<?php

namespace AndreaMarelli\ImetCore\Policies;

use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Auth\Access\HandlesAuthorization;
use \ImetUser as User;


class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks
     *
     * @param \App\Models\User|\ImetUser $user
     * @param string $ability
     * @return void|bool
     */
    public function before($user, string $ability)
    {
        // authorize any route to ADMINISTRATOR
        if (Role::isAdmin($user)) {
            return true;
        }
    }

    /**
     * Determine whether the user can manage Roles
     * Every role can access the index route but the list will be filtered accordingly
     *
     * @param \App\Models\User|\ImetUser $user
     * @return bool
     */
    public function manage($user): bool
    {
        return false;
    }

}