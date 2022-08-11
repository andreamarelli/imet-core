<?php

namespace AndreaMarelli\ImetCore\Models\User;

use AndreaMarelli\ModularForms\Models\BaseModel;
use Illuminate\Support\Facades\Auth;
use ProtectedAreaAlias;


/**
 * Class Role
 *
 * @property int $user_id
 * @property string $country
 * @property string $wdpa
 *
 */
class Role extends BaseModel
{
    protected $table = 'user_roles';

    const ROLE_ADMINISTRATOR = 'administrator';
    const ROLE_AUTHORITY = 'authority';
    const ROLE_ENCODER = 'encoder';
    const ROLE_OBSERVATORY = 'observatory';

    protected $fillable = [
        'role',
        'country',
        'wdpa'
    ];

    /**
     * Retrieve roles by user id
     *
     * @param $user_id
     * @return \AndreaMarelli\ImetCore\Models\User\Role[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getByUser($user_id)
    {
        return static::where('user_id', $user_id)->get();
    }

    /**
     * Check whether the user has the given role
     *
     * @param $role
     * @param $user
     * @return bool
     */
    public static function isRole($role, $user = null): bool
    {
        $user = $user ?? Auth::user();
        return $role === $user->imet_role;
    }

    /**
     * Check whether the user is an administrator
     *
     * @param $user
     * @return bool
     */
    public static function isAdmin($user = null): bool
    {
        return static::isRole(static::ROLE_ADMINISTRATOR, $user);
    }

    /**
     * Check whether the user has any role in IMET
     *
     * @param $user
     * @return bool
     */
    public static function hasAnyRole($user = null): bool
    {
        return static::isRole(static::ROLE_ADMINISTRATOR, $user)
            || static::isRole(static::ROLE_AUTHORITY, $user)
            || static::isRole(static::ROLE_OBSERVATORY, $user)
            || static::isRole(static::ROLE_AUTHORITY, $user);
    }



    /**
     * Retrieve the allowed countries
     * Returns NULL in case there are no limitations
     *
     * @return array|null
     */
    public static function allowedCountries(): ?array
    {
        $user = Auth::user();

        if(!static::isAdmin($user)){

            $roles = static::getByUser($user->getAuthIdentifier());

            $allowed_role_countries     = array_filter($roles->pluck('country')->toArray());
            $allowed_role_wdpas         = array_filter($roles->pluck('wdpa')->toArray());

            $allowed_countries_from_wdpas = ProtectedAreaAlias::getCountriesISO(function ($query) use ($allowed_role_wdpas) {
                $query->whereIn('wdpa_id', array_values($allowed_role_wdpas));
            });

            return array_merge(
                $allowed_role_countries,
                $allowed_countries_from_wdpas
            );
        }

        return null;
    }

    /**
     * Retrieve the allowed wdpas
     *
     * @return array|null
     */
    public static function allowedWdpas(): ?array
    {
        $user = Auth::user();

        if(!static::isAdmin($user)){
            $roles = static::getByUser($user->getAuthIdentifier());

            $allowed_role_countries     = array_filter($roles->pluck('country')->toArray());
            $allowed_role_wdpas         = array_filter($roles->pluck('wdpa')->toArray());

            $allowed_wdpas_from_countries = (new ProtectedAreaAlias())
                ->where(function ($query) use($allowed_role_countries) {
                    foreach ($allowed_role_countries as $c){
                        $query->orWhere('country', 'LIKE', '%' . $c . '%');
                    }
                })
                ->get()
                ->sortBy('name')
                ->pluck('wdpa_id')
                ->unique()
                ->toArray();

            return array_merge(
                $allowed_role_wdpas,
                $allowed_wdpas_from_countries
            );
        }

        // Unfiltered (only IMET administrators)
        return null;
    }


}