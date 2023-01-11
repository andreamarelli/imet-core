<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CommonFunctions;

trait V1 {

    private static function score_table($imet_id, $module_class, $module_field, $function_variant = null): ?float
    {
        $records = $module_class::getModuleRecords($imet_id)['records'];
        $values = collect($records)
            ->pluck($module_field)
            ->filter(function ($value) {
                return $value != -99;
            })
            ->toArray();

        $average = static::average($values, null);
        $score = $average!==null ? $average / 3 * 100 : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    private static function score_group($imet_id, $module_class, $module_field, $group_field, $function_variant = null): ?float
    {
        $records = $module_class::getModuleRecords($imet_id)['records'];
        $values = collect($records)
            ->groupBy($group_field)
            ->map(function($group) use($module_field) {
                $group_values = $group
                    ->filter(function ($value) use($module_field) {
                        return $value[$module_field] != -99;
                    })
                    ->pluck($module_field)
                    ->toArray();
                return !empty($group_values)
                    ? static::average($group_values, null)
                    : null;
            })
            ->filter(function ($value) {
                return $value != -99;
            })
            ->toArray();

        $average = static::average($values, null);
        $score = $average!==null ? $average / 3 * 100 : null;

//        if($module_class == 'AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\Implications'){
//            dd($values, $average, $score);
//        }

        return $score!== null ?
            round($score, 2)
            : null;
    }


}