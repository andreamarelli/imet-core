<?php

namespace AndreaMarelli\ImetCore\Models\User;

use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ModularForms\Helpers\Locale;
use AndreaMarelli\ModularForms\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;


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
        'user_id',
        'country',
        'wdpa'
    ];

    /**
     * Relation to ProtectedArea
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wdpa_obj(): HasOne
    {
        return $this->hasOne(ProtectedArea::class, 'wdpa_id', 'wdpa');
    }

    /**
     * Relation to Country
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country_obj(): HasOne
    {
        return $this->hasOne(Country::class, 'iso3', 'country');
    }

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
     * Check whether the user has any valid role in IMET
     *
     * @param $user
     * @return bool
     */
    public static function hasAnyRole($user = null): bool
    {
        $user = $user ?? Auth::user();
        return static::isRole(static::ROLE_ADMINISTRATOR, $user)
            || static::isRole(static::ROLE_AUTHORITY, $user)
            || static::isRole(static::ROLE_OBSERVATORY, $user)
            || static::isRole(static::ROLE_ENCODER, $user);
    }

    /**
     * Retrieve the allowed wdpas
     *
     * @param null $user
     * @param bool $only_wdpa
     * @return \AndreaMarelli\ImetCore\Models\ProtectedArea[]|array|\Illuminate\Database\Eloquent\Collection|null
     */
    public static function allowedWdpas($user = null, bool $only_wdpa = true)
    {
        $user = $user ?? Auth::user();

        if(!Role::isAdmin($user)){

            // Retrieve allowed WDPAs and ISO from Role
            $roles                  = Role::getByUser($user->getAuthIdentifier());
            $allowed_role_countries = array_filter($roles->pluck('country')->toArray());
            $allowed_role_wdpas     = array_filter($roles->pluck('wdpa')->toArray());

            // Retrieve ProtectedArea using allowed filters
            $protected_areas = (new ProtectedArea())
                // filter by role WDPA
                ->whereIn('wdpa_id', $allowed_role_wdpas)
                // filter by role ISO
                ->orWhere(function ($query) use ($allowed_role_countries) {
                    foreach ($allowed_role_countries as $c) {
                        $query->orWhere('country', 'LIKE', '%' . $c . '%'); // use LIKE for over-national WDPAs
                    }
                })
                ->get()
                ->sortBy('name');

            return $only_wdpa
                ? $protected_areas->pluck('wdpa_id')->unique()->toArray()
                : $protected_areas;
        }

        // Unfiltered (only IMET administrators)
        return null;
    }


    /**
     * Retrieve the allowed countries
     * Returns NULL in case there are no limitations
     *
     * @param null $user
     * @param bool $only_iso
     * @return \AndreaMarelli\ImetCore\Models\Country[]|array|\Illuminate\Database\Eloquent\Collection|null
     */
    public static function allowedCountries($user = null, bool $only_iso = true)
    {
        $user = $user ?? Auth::user();

        if(!static::isAdmin($user)) {
            // Retrieved allowed ISOs from allowed WDPAs
            $allowed_isos = Role::allowedWdpas($user, false)
                ->pluck('country')
                ->unique()
                ->toArray();
        } else {
            // Unfiltered: retrieve all ISOs from ProtectedArea
            $allowed_isos = ProtectedArea::all()
                ->pluck('country')
                ->unique()
                ->sort()
                ->toArray();
        }

        // Parse for over-national WDPAs
        $parsed_isos = ProtectedArea::parseISOs($allowed_isos);

        return $only_iso
            ? $parsed_isos
            : Country::select(['iso3', 'iso2', 'name_' . Locale::lower()])
                ->whereIn('iso3', $parsed_isos)
                ->get();
    }

    /**
     * Check whether the wdpa is in the allowed list for the given user
     *
     * @param $wdpa
     * @param $user
     * @return bool
     */
    public static function isWdpaAllowed($wdpa, $user = null): bool
    {
        $user = $user ?? Auth::user();

        if(!static::isAdmin($user)) {
            $allowed_wdpas = static::allowedWdpas($user);
            return in_array($wdpa, $allowed_wdpas);
        }

        // always allowed (only IMET administrators)
        return true;
    }


}