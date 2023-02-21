<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\oecm;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\EquipmentMaintenance;

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

}