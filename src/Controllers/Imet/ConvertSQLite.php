<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;


use AndreaMarelli\ImetCore\Models\Imet\v1\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet_Eval;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;

trait ConvertSQLite{

    /**
     * Convert IMET
     *
     * @param $imet
     * @param $sqlite_connection
     * @return array
     */
    public static function convert($imet, $sqlite_connection): array
    {
        // Retrieve WDPAID
        [$wdpa, $pa_name] = Modules\Component\ImetModule::conversionIdentifyPa($imet, $sqlite_connection);

        if(!empty($wdpa)){

            $form = new Imet();
            $form->name = $pa_name;
            $form->wdpa_id = $wdpa;
            $form->Country = $imet->Country;
            $form->Year = $imet->Year;
            $form->version = 'v1';

            $json = ControllerV1::export($form, false, false);

            foreach (Imet::allModules() as $module_class) {
                if (array_key_exists($module_class::getShortClassName(), $json['Context'])) {
                    $json['Context'][$module_class::getShortClassName()] = $module_class::convert($imet, $sqlite_connection);
                }
            }

            foreach (Imet_Eval::allModules() as $module_class) {
                if (array_key_exists($module_class::getShortClassName(), $json['Evaluation'])) {
                    $json['Evaluation'][$module_class::getShortClassName()] = $module_class::convert($imet, $sqlite_connection);
                }

            }

            dd($json['Context']);
//            dd(json_decode(json_encode($json)));

            return $json;
        }
        if(!empty($pa_name)){

            $form = new Imet();
            $form->name = $pa_name;
            $form->wdpa_id = ProtectedAreaNonWdpa::generate_fake_wdpa();
            $form->Country = $imet->Country;
            $form->Year = $imet->Year;
            $form->version = 'v1';

            $json = ControllerV1::export($form, false, false);
            $json['NonWdpaProtectedArea']['name'] = $pa_name;
            $json['NonWdpaProtectedArea']['country'] = $imet->Country;

            return $json;
        }

        return [];
    }


}
