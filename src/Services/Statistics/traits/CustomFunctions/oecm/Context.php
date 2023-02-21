<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\oecm;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\KeyElements;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\SupportsAndConstraints;

trait Context {

    protected static function score_c12($imet_id): ?float
    {
        $module_class = KeyElements::class;
        $group_field = 'group_key';
        $module_field = 'EvaluationScore';

        $records = $module_class::getModule($imet_id);
        $values = $records
            ->filter(function ($record){
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0
                    && $record['IncludeInStatistics']==1;
            })
            ->groupBy($group_field)
            ->map(function($group) use($module_field) {
                $group_values = $group
                    ->pluck($module_field)
                    ->toArray();
                return !empty($group_values)
                    ? static::average($group_values, null)
                    : null;
            })
            ->toArray();

        $average = static::average($values, null);
        $score = $average!==null ? $average / 3 * 100 : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_c2($imet_id): ?float
    {
        $records = SupportsAndConstraints::getModule($imet_id);

        $values = $records
            ->filter(function ($record){
                return $record['Influence'] !== null
                    && intval($record['Influence']) > -4
                    && $record['ConstraintLevel'] !== null
                    && intval($record['ConstraintLevel']) > -4;
            })->map(function ($record){
                $record['ConstraintLevel'] = $record['ConstraintLevel']===null
                    ? 1
                    : $record['ConstraintLevel'];
                return $record;
            });

        $numerator = $values->sum(function ($item){
            return $item['ConstraintLevel'] * $item['Influence'];
        });
        $denominator = $values->sum('Influence');

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

}
