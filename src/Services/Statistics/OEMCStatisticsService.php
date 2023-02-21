<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\AdministrativeManagement;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\CapacityAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\DesignAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Designation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\EmpowermentGovernance;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\HRmanagementPolitics;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\InformationAvailability;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Objectives;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\RegulationsAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\StaffCompetence;
use AndreaMarelli\ImetCore\Services\Statistics\traits\CommonFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\Math;

class OEMCStatisticsService extends StatisticsService
{
    use CommonFunctions;
    use CustomFunctions\oecm\Context;
    use CustomFunctions\oecm\Inputs;
    use CustomFunctions\oecm\Process;
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
            'i1' => static::score_group($imet_id, InformationAvailability::class, 'EvaluationScore', 'group_key'),
            'i2' => static::score_group($imet_id, CapacityAdequacy::class, 'Adequacy', 'group_key'),
            'i3' => static::score_i3($imet_id),
            'i4' => static::score_i4($imet_id),
            'i5' => static::score_i5($imet_id),
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
            'pr1' => static::score_table($imet_id, StaffCompetence::class, 'EvaluationScore'),
            'pr2' => static::score_table($imet_id, HRmanagementPolitics::class, 'EvaluationScore'),
            'pr3' => static::score_group($imet_id, EmpowermentGovernance::class, 'EvaluationScore', 'group_key'),
            'pr4' => static::score_table($imet_id, AdministrativeManagement::class, 'EvaluationScore', 4),
            'pr5' => self::score_pr5($imet_id),
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