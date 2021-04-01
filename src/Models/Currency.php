<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ModularForms\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class Currency
 *
 * @property string $iso
 * @property string $name_fr
 * @property string $name_en
 * @property string $name_sp
 *
 * @package AndreaMarelli\ImetCore\Models
 */
class Currency extends BaseModel
{
    protected $table = 'imet.imet_currencies';
    protected $primaryKey = 'iso';
    public $incrementing = false;       // needed for non integer primaryKey

    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    public const UPDATED_BY = null;

    public const LABEL = 'name_' . UPPER_LOCALE;

    public const MINIMAL_CURRENCIES = ['EUR', 'USD'];

    /**
     * Exchange rates
     */
    private const USD_EUR = 0.89;
    private const GBP_EUR = 1.11;
    private const CNY_EUR = 0.13;
    private const JPY_EUR = 0.0082;
    private const XAF_EUR = 0.0015;
    private const CFA_EUR = 0.0015;
    private const STD_EUR = 0.0000411945;
    private const BIF_EUR = 0.00048;
    private const CDF_EUR = 0.00054;
    private const RWF_EUR = 0.00097;

    /**
     * Override: get locale of IMET form
     * @param string $type
     * @param Collection|null $collection
     * @param array $fields
     * @return array
     */
    public static function imetV1List($type = 'PAIRS', Collection $collection = null, $fields = [])
    {
        $lang = App::getLocale() ?? Config::get('app.locale');
        return parent::selectionList('FIELDS', $collection, ['name_'.$lang, 'iso3']);
    }

    /**
     * Exchange between 2 given currency
     * @param $amount
     * @param $in_currency
     * @param $out_currency
     * @return float
     */
    public static function exchange($amount, $in_currency, $out_currency): float
    {
        $in_currency = strtoupper($in_currency);
        $out_currency = strtoupper($out_currency);
        if($in_currency!='' && $out_currency!=='' && $in_currency!==$out_currency){
            if($in_currency!=='EUR'){
                // first convert to EUR
                $amount = $amount * constant('static::'.$in_currency.'_EUR');
                // then convert to target currency
                if($out_currency!=='EUR'){
                    $amount = $amount / constant('static::'.$out_currency.'_EUR');
                }
            } else {
                $amount = $amount / constant('static::'.$out_currency.'_EUR');
            }
        }
        return (float) $amount;
    }

}
