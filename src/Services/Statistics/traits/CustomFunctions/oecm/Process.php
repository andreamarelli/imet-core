<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\oecm;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\EquipmentMaintenance;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\StakeholderCooperation;

trait Process
{
    protected static function score_pr5($imet_id): ?float
    {
        $records = EquipmentMaintenance::getModule($imet_id);

        $values = $records
            ->map(function($record){
                $record['numerator'] = $record['EvaluationScore']==="-99" || $record['EvaluationScore']===null
                    ? null
                    : intval($record['EvaluationScore']) * $record['AdequacyLevel'];
                $record['denominator'] = $record['EvaluationScore']==="-99" || $record['EvaluationScore']===null
                    ? null
                    : $record['AdequacyLevel'];
                $record['denominator'] = $record['denominator'] ?? 0;
                return $record;
            });

        $numerator = $values->sum('numerator');
        $denominator = $values->sum('denominator');

        $score = $denominator>0
            ? $numerator / $denominator / 3 * 100
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_pr8($imet_id): ?float
    {
        $records = StakeholderCooperation::getModule($imet_id);

        $values = $records
            ->sortBy("Element")
            ->map(function($record){
                $record['score'] = $record['Cooperation'] === "-99" ? 0 : $record['Cooperation'];
                $record['weight'] =
                    ($record['MPInvolvement'] ?? 0) +
                    ($record['BAInvolvement'] ?? 0) +
                    ($record['EEInvolvement'] ?? 0) +
                    ($record['MPIImplementation'] ?? 0);
                return $record;
            })
            ->groupBy('group_key')
            ->map(function($group){
                $sw = $group->sum('weight');
                $wi = (function($data) {
                    $sum = null;
                    foreach ($data as $item){
                        if($item['score']===null || $item['weight']===null){
                            continue;
                        } else {
                            $sum += ($item['score'] / 3 * $item['weight']);
                        }
                    }
                    return $sum;
                })($group);
                return [
                    'sw' => $sw,
                    'wi' => $wi,
                ];
            });

        $numerator = $values->sum('wi');
        $denominator = $values->sum('sw');

        $score = $denominator>0
            ? $numerator / $denominator * 100
            : null;


        return $score!== null ?
            round($score, 2)
            : null;
    }

}