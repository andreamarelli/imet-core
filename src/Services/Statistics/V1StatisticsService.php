<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Services\Statistics\traits\DBFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\Math;


class V1StatisticsService extends StatisticsService
{
    use DBFunctions;
    use Math;

    const SCHEMA = 'imet_assessment'; // todo: to be removed after conversion to PHP

    /**
     * Return CONTEXT step scores
     *
     * @param $imet
     * @return array
     */
    public static function scores_context($imet): array
    {
        $imet_id = $imet->getKey();

        $scores = [
            'c11' => static::table_db_function($imet_id, 'eval_importance_c11', 'EvaluationScore'),
            'c12' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c12', 'eval_importance_c12'),
            'c13' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c13', 'eval_importance_c13'),
            'c14' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c14', 'eval_importance_c14'),
            'c15' => static::table_db_function($imet_id, 'eval_importance_c15', 'EvaluationScore'),
            'c16' => static::table_db_function($imet_id, 'eval_importance_c16', 'EvaluationScore'),
        ];
        $scores['c1'] = self::average($scores);
        $scores['c2'] = static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c2', 'eval_supports_and_constaints');
        $scores['c3'] = static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c3', 'context_menaces_pressions');

        // average step score
        $sum = ($scores['c1'] ?? 0)
            + (($scores['c2'] ?? 0) / 2 + 50)
            + (($scores['c3'] ?? 0) + 100);
        $count = count(array_filter([$scores['c1'], $scores['c2'], $scores['c3']], function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

    /**
     * Return PLANNING step scores
     *
     * @param $imet
     * @return array
     */
    public static function scores_planning($imet): array
    {
        $imet_id = $imet->getKey();

        $scores = [
            'p1' => static::table_db_function($imet_id, 'eval_regulations_adequacy', 'EvaluationScore'),
            'p2' => static::table_db_function($imet_id, 'eval_design_adequacy', 'EvaluationScore'),
            'p3' => static::rank_db_function($imet_id, 'eval_boundary_level', 'EvaluationScore', 'EVAL P3'),
            'p4' => static::table_db_function($imet_id, 'eval_management_plan', 'PlanExistenceScore'),
            'p5' => static::table_db_function($imet_id, 'eval_work_plan', 'PlanExistenceScore'),
            'p6' => static::table_db_function($imet_id, 'eval_objectives', 'EvaluationScore'),
        ];

        // average step score
        $sum = (($scores['p1'] ?? 0) / 2 + 50)
            + (($scores['p2'] ?? 0) / 2 + 50)
            + ($scores['p3'] ?? 0)
            + ($scores['p4'] ?? 0)
            + ($scores['p5'] ?? 0)
            + ($scores['p6'] ?? 0);
        $count = count(array_filter($scores, function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

    /**
     * Return INPUTS step scores
     *
     * @param $imet
     * @return array
     */
    public static function scores_inputs($imet): array
    {
        $imet_id = $imet->getKey();

        $scores = [
            'i1' => static::group_db_function($imet_id, 'eval_information_availability', 'EvaluationScore', 'group_key'),
            'i2' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_i2', 'eval_staff', ['EvaluationScore']),
            'i3' => static::rank_db_function($imet_id, 'eval_budget_adequacy', 'EvaluationScore', 'EVAL I3'),
            'i4' => static::rank_db_function($imet_id, 'eval_budget_securization', 'EvaluationScore', 'EVAL I4'),
            'i5' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_i5', 'eval_management_equipment_adequacy', ['EvaluationScore']),
        ];

        // average step score
        $scores['avg_indicator'] = static::average([
               $scores['i1'],  $scores['i2'], $scores['i3'], $scores['i4'], $scores['i5']
           ], 1);

        return $scores;
    }
    public static function scores_process($imet): array {return ['avg_indicator' => null];}
    public static function scores_outputs($imet): array {return ['avg_indicator' => null];}
    public static function scores_outcomes($imet): array {return ['avg_indicator' => null];}

}