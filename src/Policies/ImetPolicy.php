<?php

namespace AndreaMarelli\ImetCore\Policies;

use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Auth\Access\HandlesAuthorization;
use \ImetUser as User;


class ImetPolicy
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
     * Determine whether the user can INDEX
     * Every role can access the index route but the list will be filtered accordingly
     *
     * @param \App\Models\User|\ImetUser $user
     * @return bool
     */
    public function viewAny($user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can UPDATE
     *
     * @param \App\Models\User|\ImetUser $user
     * @param $form
     * @return bool
     */
    public function view($user, $form = null): bool
    {
        if(is_null($form)){
            return Role::hasAnyRole($user);
        } else {
            return Role::isWdpaAllowed($form->wdpa_id, $user);
        }
    }

    /**
     * Determine whether the user can UPDATE
     *
     * @param \App\Models\User|\ImetUser $user
     * @param $form
     * @return bool
     */
    public function edit($user, $form = null): bool
    {
        if(is_null($form)){
            return Role::isRole(Role::ROLE_ENCODER);
        } else {
            return Role::isWdpaAllowed($form->wdpa_id, $user);
        }
    }

    /**
     * Determine whether the user can UPDATE
     *
     * @param \App\Models\User|\ImetUser $user
     * @param $form
     * @return bool
     */
    public function update($user, $form = null): bool
    {
        // if user can EDIT can also UPDATE
        return $this->edit($user, $form);
    }

    /**
     * Determine whether the user can CREATE
     *
     * @param \App\Models\User|\ImetUser $user
     * @return bool
     */
    public function create($user): bool
    {
        // if user can EDIT can also CREATE
        return $this->edit($user);
    }

    /**
     * Determine whether the user can DESTROY
     *
     * @param \App\Models\User|\ImetUser $user
     * @param $form
     * @return bool
     */
    public function destroy($user, $form = null): bool
    {
        // if user can EDIT can also DESTROY
        return $this->edit($user, $form);
    }

}
