<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\DesignAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Designation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Objectives;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\RegulationsAdequacy;
use AndreaMarelli\ImetCore\Services\Statistics\traits\CommonFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\Math;

class OEMCStatisticsService extends StatisticsService
{
    use CommonFunctions;
    use CustomFunctions\oecm\Context;
    use Math;

    /**
     * Override: Ensure to return IMET model
     *
     * @param $imet
     * @return Imet
     */
    protected static function get_imet($imet): Imet
    {
        if(is_int($imet) or is_string($imet)){
            $imet = Imet::find($imet);
        }
        return $imet;
    }

    /**
     * Return CONTEXT step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_context($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'c11' => static::score_table($imet_id, Designation::class, 'EvaluationScore'),
            'c12' =>  static::score_c12($imet_id)
        ];
        $scores['c1'] = self::average($scores);
        $scores['c2'] =  static::score_c2($imet_id);

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 2);

        return $scores;
    }

    /**
     * Return PLANNING step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_planning($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'p1' => static::score_table($imet_id, RegulationsAdequacy::class, 'EvaluationScore'),
            'p2' => static::score_table($imet_id, DesignAdequacy::class, 'EvaluationScore'),
            'p3' => null,
            'p4' => null,
            'p5' => null,
            'p6' => static::score_table($imet_id, Objectives::class, 'EvaluationScore'),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        return $scores;
    }

    /**
     * Return INPUTS step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_inputs($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'i1' => null,
            'i2' => null,
            'i3' => null,
            'i4' => null,
            'i5' => null,
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        return $scores;
    }

    /**
     * Return PROCESS step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_process($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'pr1' => null,
            'pr2' => null,
            'pr3' => null,
            'pr4' => null,
            'pr5' => null,
            'pr6' => null,
            'pr7' => null,
            'pr8' => null,
            'pr9' => null,
            'pr10' => null,
            'pr11' => null,
            'pr12' => null,

        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        return $scores;
    }

    /**
     * Return OUTPUTS step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_outputs($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'op1' => null,
            'op2' => null,

        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 2);

        return $scores;
    }

    /**
     * Return OUTCOMES step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_outcomes($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'oc1' => null,
            'oc2' => null,
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 2);

        return $scores;
    }

}