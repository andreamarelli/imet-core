<?php

namespace AndreaMarelli\ImetCore\Helpers;

use AndreaMarelli\ImetCore\Models\Country;
use AndreaMarelli\ImetCore\Models\Imet\Components\Modules\ImetModule;
use AndreaMarelli\ModularForms\Helpers\Template as BaseTemplate;

class Template{

    /**
     * Return country flag + name from ISO
     * @param $iso
     * @return string
     * @throws \Exception
     */
    public static function flag_and_name($iso): string
    {
        if($iso!=''){
            $country = Country::getByISO($iso);
            $iso = $country->iso2;
            $label = '&nbsp;'.$country->name;
            return BaseTemplate::flag($iso, $country->name).$label;
        }
        return '';
    }

    /**
     * Return country flag from ISO
     *
     * @param $iso
     * @return string
     * @throws \Exception
     */
    public static function flag($iso): string
    {
        if($iso!=''){
            $country = Country::getByISO($iso);
            $iso = $country->iso2;
            return BaseTemplate::flag($iso, $country->name);
        }
        return '';
    }

    /**
     * Return scope icon (marine or terrestrial)
     *
     * @param $scope
     * @return string
     */
    public static function module_scope($scope): string
    {
        $terrestrial = '<img src="/vendor/imet-core/images/tree.png" class="inline" />
                    <tooltip>' . ucfirst(trans('imet-core::common.terrestrial')) .'</tooltip>';

        $marine = '<img src="/vendor/imet-core/images/fish.png" class="inline" />
                    <tooltip>' . ucfirst(trans('imet-core::common.marine')) .'</tooltip>';

        if($scope === ImetModule::TERRESTRIAL_AND_MARINE){
            return $terrestrial.$marine;
        } elseif ($scope === ImetModule::TERRESTRIAL){
            return $terrestrial;
        } elseif ($scope === ImetModule::MARINE){
            return $marine;
        }
        return '';
    }

}
