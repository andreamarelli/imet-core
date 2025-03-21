<?php

namespace ImetCore\Models;

use ImetCore\Helpers\Database;
use ImetCore\Models\User\Role;
use ModularForms\Helpers\Locale;
use ModularForms\Models\Utils\Country as BaseCountry;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use ImetCore\Models\Region;
use Illuminate\Support\Facades\App;


/**
 * Class Country
 *
 * @property integer $iso2
 * @property integer $iso3
 * @property string $name
 * @property string $Name
 *
 * @package ImetCore\Models
 */
class Country extends BaseCountry
{
    protected string $schema = Database::COMMON_IMET_SCHEMA;
    protected $table = 'imet_countries';
    public $primaryKey = 'iso3';
    public static $foreign_key = 'region_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        [$this->table, $this->connection] = Database::getTableAndConnection($this->table,$this->schema);
    }

    /**
     * Get the region associated with the country.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get country by regions
     * @throws Exception
     */
    public static function getByRegion($region): array
    {
        if(strlen($region)==2){
            return static::where('region_id', $region)->pluck('iso3')->toArray();
        }else {
            throw new Exception('Wrong size for region: '. $region);
        }
    }

    /**
     * Override: get only allowed countries
     * @param string $type
     * @param Collection|null $collection
     * @param array $fields
     * @return array
     */
    public static function selectionList($type = 'PAIRS', Collection $collection = null, $fields = []): array
    {
        $allowed_countries = Role::allowedCountries();
        $collection = static::select(['iso3', 'name_'.Locale::lower()])
            ->where(function ($query) use ($allowed_countries){
                if($allowed_countries!==null){
                    $query->whereIn('iso3', array_values($allowed_countries));
                }
            })
            ->get();

        return parent::selectionList('FIELDS', $collection);
    }


}
