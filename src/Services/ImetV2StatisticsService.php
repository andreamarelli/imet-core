<?php

namespace AndreaMarelli\ImetCore\Services;

use AndreaMarelli\ImetCore\Controllers\Imet\EvalController;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\ManagementPlan;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\WorkPlan;


class ImetV2StatisticsService extends ImetStatisticsService
{
    use DBFunctions;
    use Math;

    const SCHEMA = 'imet_assessment_v2'; // todo: to be removed after conversion to PHP

    public static function get_scores(Imet $imet, string $step = 'global'): array
    {
        if($step === 'global'){
            $scores = [
                'context' => static::scores_context($imet)['avg_indicator'],
                'planning' => static::scores_planning($imet)['avg_indicator'],
                'inputs' => static::scores_inputs($imet)['avg_indicator'],
                'process' => static::scores_process($imet)['avg_indicator'],
                'outputs' => static::scores_outputs($imet)['avg_indicator'],
                'outcomes' => static::scores_outcomes($imet)['avg_indicator'],
            ];
        }
        return $scores;
    }

    private static function scores_context($imet)
    {
        $imet_id = $imet->getKey();

        $scores = [
            'c11' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c12', 'eval_importance_c12'),
            'c12' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c13', 'eval_importance_c13'),
            'c13' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c14', 'eval_importance_c14'),
            'c14' => static::table_db_function($imet_id, 'eval_importance_c15', 'EvaluationScore'),
            'c15' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c15', 'eval_importance_c16'),
        ];
        $scores['c1'] = self::average($scores);
        $scores['c2'] = static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c2', 'eval_supports_and_constaints');
        $scores['c3'] = static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c3', 'context_menaces_pressions');

        // average step score
        $sum = ($scores['c1'] ?? 0)
            + ($scores['c2'] ? $scores['c2']/2+50 : 0)
            + ($scores['c3'] ? $scores['c3']+100 : 0);
        $count = count(array_filter([$scores['c1'], $scores['c2'], $scores['c3']], function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

    private static function scores_planning($imet)
    {
        $imet_id = $imet->getKey();

        $scores = [
            'p1' => static::table_db_function($imet_id, 'eval_regulations_adequacy', 'EvaluationScore'),
            'p2' => static::table_db_function($imet_id, 'eval_design_adequacy', 'EvaluationScore'),
            'p3' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_p3', 'eval_boundary_level_v2'),
            'p4' => static::eval_plans($imet_id, ManagementPlan::class),
            'p5' => static::eval_plans($imet_id, WorkPlan::class),
            'p6' => static::table_db_function($imet_id, 'eval_objectives', 'EvaluationScore'),
        ];

        // average step score
        $sum = ($scores['p1'] ?? 0)
            + ($scores['p2'] ?? 0)
            + ($scores['p3'] ?? 0)
            + ($scores['p4'] ?? 0)
            + ($scores['p5'] ?? 0)
            + ($scores['p6'] ?? 0);
        $count = count(array_filter($scores, function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

//        if($imet->getKey()===7){
//            dd(
//                ((array) EvalController::assessment($imet_id, 'global'))['original'],
//                ((array) EvalController::assessment($imet_id, 'planning'))['original'],
//                $scores,
//            );
//        }

        return $scores;
    }

    private static function scores_inputs($imet)
    {
        $imet_id = $imet->getKey();

        $scores = [];
        $scores['avg_indicator'] = null;
        // TODO

        return $scores;
    }
    private static function scores_process($imet)
    {
        $imet_id = $imet->getKey();

        $scores = [];
        $scores['avg_indicator'] = null;
        // TODO

        return $scores;
    }
    private static function scores_outputs($imet)
    {
        $imet_id = $imet->getKey();

        $scores = [];
        $scores['avg_indicator'] = null;
        // TODO

        return $scores;
    }
    private static function scores_outcomes($imet)
    {
        $imet_id = $imet->getKey();

        $scores = [];
        $scores['avg_indicator'] = null;
        // TODO

        return $scores;
    }


    /**
     * Custom function for ManagementPlan and WorkPlan
     * @param $imet
     * @return float|int|null
     */
    private static function eval_plans($imet, $module_class)
    {
        $record = $module_class::where('FormID', $imet)->first();

        $score = null;
        if($record){
            $record = $record->toArray();

            $denominator_VisionAdequacy =
                intval($record['VisionAdequacy'])!==0
                ? (1 - ($record['VisionAdequacy'] / $record['VisionAdequacy']))  // This seems to be wrong
                // Original PostgreSQL:   (1 - (eval_work_plan."VisionAdequacy"/nullif(eval_work_plan."VisionAdequacy", 0))
                : null;

            $denominator_PlanAdequacyScore =
                intval($record['PlanAdequacyScore'])!==0
                ? (1 - ($record['PlanAdequacyScore'] / $record['PlanAdequacyScore']))  // This seems to be wrong (same as VisionAdequacy)
                : null;

            $denominator = (($denominator_VisionAdequacy ?? 3) + ($denominator_PlanAdequacyScore ?? 3));

            if($denominator!==null && $denominator!==0){
                $score =
                    100 * (
                        $record['PlanExistence']
                        + ($record['PlanUptoDate'] ?? 0)
                        + ($record['PlanApproved'] ?? 0)
                        + ($record['PlanImplemented'] ?? 0)
                        + ($record['VisionAdequacy'] ?? 0)
                        + ($record['PlanAdequacyScore'] ?? 0)
                    )
                    / (10 - $denominator);
            }

        }
        return $score;
    }




}