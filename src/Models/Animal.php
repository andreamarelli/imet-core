<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ModularForms\Models\Utils\Animal as BaseAnimal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Animal
 *
 * @property string $kingdom
 * @property string $phylum
 * @property string $class
 * @property string $order
 * @property string $family
 * @property string $genus
 * @property string $specie
 * @property string $common_name_fr
 * @property string $common_name_en
 * @property string $common_name_sp
 * @property integer $iucn_redlist_id
 * @property string $iucn_redlist_category
 * @property string $country_distribution (in JSON)
 *
 * @property-read string $name
 * @property-read string $binomial
 *
 * @package AndreaMarelli\ImetCore\Models\Animals
 */
class Animal extends BaseAnimal
{
    protected $table = 'species';
    protected $primaryKey = 'id';

}
