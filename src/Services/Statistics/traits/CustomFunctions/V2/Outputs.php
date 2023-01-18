<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\V2;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\AreaDomination;

trait Outputs
{
    protected static function score_op3($imet_id): ?float
    {
        $values = AreaDomination::getModule($imet_id)
            ->toArray();
        $values = $values[0] ?? null;

        $score = null;
        if($values){

            $numerator = ($values['Patrol'] ?? 0)
                + ($values['RapidIntervention'] ?? 0)
                + ($values['AirVehicles'] ? 1 : 0)
                + ($values['Planes'] ? 1 : 0);

            $denominator = 3
                * (($values['Patrol']!==null ? 1 : 0) + ($values['RapidIntervention']!==null ? 1 : 0))
                + (($values['AirVehicles']!==null ? 1 : 0) + ($values['Planes']!==null ? 1 : 0));

            $score = $denominator>0
                ? 100 * $numerator / $denominator
                : null;

        }

        return $score!== null ?
            round($score, 2)
            : null;
    }
}