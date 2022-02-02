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

        if (empty($wdpa) && empty($pa_name)){
            return [];
        }

        $form          = new Imet();
        $form->name    = $pa_name;
        $form->Country = $imet->Country;
        $form->Year    = $imet->Year;
        $form->version = 'v1';
        $form->wdpa_id = !empty($wdpa) ? $wdpa : ProtectedAreaNonWdpa::generate_fake_wdpa();

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

        if(!empty($pa_name)){
            $json['NonWdpaProtectedArea']['name'] = $pa_name;
            $json['NonWdpaProtectedArea']['country'] = $imet->Country;
        }

        return $json;
    }


}
