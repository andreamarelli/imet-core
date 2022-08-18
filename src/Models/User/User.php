<?php

namespace AndreaMarelli\ImetCore\Models\User;

use \AndreaMarelli\ModularForms\Models\User\User as BaseUser;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * Class User
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $full_name
 * @property string $imet_role
 * @mixin \Illuminate\Database\Eloquent\Model
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends BaseUser
{
    /**
     * Override: set the fillable attributes
     * @var string[]
     */
    protected $fillable = [
        'id',
        'email',
        'password',
        'first_name',
        'last_name',
        'organisation',
        'function',
        'country',
        'imet_role'
    ];

    /**
     * Relation to Role
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imet_roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }
    
    /**
     * Override: Retrieve the name of the user
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->full_name ;
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Search by key
     *
     * @param $search_key
     * @return mixed
     */
    public static function searchByKey($search_key)
    {
        return static::where('first_name', '~~*', '%' . $search_key . '%')
            ->orWhere('last_name', '~~*', '%' . $search_key . '%')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();
    }

}
