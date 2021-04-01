<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ModularForms\Helpers\Locale;
use AndreaMarelli\ModularForms\Models\BaseModel;

/**
 * Class ProtectedArea
 *
 * @property string $global_id
 * @property string $country
 * @property integer $wdpa_id
 * @property string $name
 * @property string $iucn_category
 * @property string $creation_date
 *
 * @package AndreaMarelli\ImetCore\Models
 */
class ProtectedArea extends BaseModel
{

    protected $table = 'imet.imet_pas';

    public $primaryKey = 'global_id';
    public $incrementing = false;       // required for textual primary_key

    public const LABEL = 'name';

    public const EXPORT = [
        'global_id',
        'country',
        'wdpa_id',
        'name',
        'iucn_category',
        'creation_date'
    ];

    /**
     * Get by WDPA id
     *
     * @param string $wdpa
     * @return \AndreaMarelli\ImetCore\Models\ProtectedArea
     */
    public static function getByWdpa(string $wdpa): ProtectedArea
    {
        return static::where('wdpa_id', $wdpa)
            ->firstOrFail();
    }

    /**
     * Get by global_id (to be deprecated)
     *
     * @param $global_id
     * @return \AndreaMarelli\ImetCore\Models\ProtectedArea|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function getByGlobalId($global_id)
    {
        return static::where('global_id', '=', $global_id)
            ->first();
    }

    /**
     * Get protected areas' countries
     *
     * @return array
     */
    public static function getCountries(): array
    {
        $countries = static::selectRaw('regexp_split_to_table(country, \'\;\') as iso3')
            ->distinct()
            ->get()
            ->pluck('iso3')
            ->sort()
            ->toArray();

        return Country::select(['iso3', 'name_'.Locale::lower()])
            ->whereIn('iso3', array_values($countries))
            ->pluck('name_'.Locale::lower(), 'iso3')
            ->sort()
            ->toArray();
    }

    /**
     * @return string
     */
    public function rawQueryToImet(): string
    {
        $values = "'".$this->global_id."', ";
        $values .= "'".$this->country."', ";
        $values .= "'".$this->wdpa_id."', ";
        $values .= "'".str_replace("'", "''", $this->name)."', ";
        $values .= "'".$this->iucn_category."', ";
        $values .= $this->creation_date!==null ? "'".$this->creation_date."'" : "NULL";
        return 'INSERT into imet.imet_pas (global_id, country, wdpa_id, name, iucn_category, creation_date) VALUES ('.$values.');';
    }

}
