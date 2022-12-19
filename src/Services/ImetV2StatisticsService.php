<?php

namespace AndreaMarelli\ImetCore\Services;

use AndreaMarelli\ImetCore\Controllers\Imet\EvalController;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\ManagementPlan;


class ImetV2StatisticsService extends ImetStatisticsService
{
    use DBFunctions;
    use Math;

    const SCHEMA = 'imet_assessment_v2'; // todo: to be removed after conversion to PHP

    public static function get_indexes(Imet $imet, string $step = 'global'): array
    {
        if($step === 'global'){
            $stats = [
                'context' => static::step_context($imet)['avg_indicator'],
                'planning' => static::step_planning($imet)['avg_indicator'],
                'inputs' => static::step_inputs($imet)['avg_indicator'],
                'process' => static::step_process($imet)['avg_indicator'],
                'outputs' => static::step_outputs($imet)['avg_indicator'],
                'outcomes' => static::step_outcomes($imet)['avg_indicator'],
            ];
        }
        return $stats;
    }

    private static function step_context($imet)
    {
        $imet_id = $imet->getKey();

        $indicators = [
            'c11' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c12', 'eval_importance_c12'),
            'c12' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c13', 'eval_importance_c13'),
            'c13' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c14', 'eval_importance_c14'),
            'c14' => static::table_db_function($imet_id, 'eval_importance_c15', 'EvaluationScore'),
            'c15' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c15', 'eval_importance_c16'),
        ];
        $indicators['c1'] = self::average($indicators);
        $indicators['c2'] = static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c2', 'eval_supports_and_constaints');
        $indicators['c3'] = static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c3', 'context_menaces_pressions');

        // average step score
        $indicators['avg_indicator'] = round(
            (($indicators['c1'] ?? 0) + ($indicators['c2'] ? $indicators['c2']/2+50 : 0) + ($indicators['c3'] ? $indicators['c3']+100 : 0))
            / count(array_filter([$indicators['c1'], $indicators['c2'], $indicators['c3']])),
            1);

        return $indicators;
    }

    private static function step_planning($imet)
    {
        $imet_id = $imet->getKey();

        $indicators = [
            'p1' => static::table_db_function($imet_id, 'eval_regulations_adequacy', 'EvaluationScore'),
            'p2' => static::table_db_function($imet_id, 'eval_design_adequacy', 'EvaluationScore'),
            'p3' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_p3', 'eval_boundary_level_v2'),
            'p4' => static::eval_management_plan($imet_id),
            'p6' => static::table_db_function($imet_id, 'eval_objectives', 'EvaluationScore'),
        ];

        $indicators['avg_indicator'] = null;

        if($imet->getKey()===10){
            dd(
                ((array) EvalController::assessment($imet_id, 'global'))['original'],
                ((array) EvalController::assessment($imet_id, 'planning'))['original'],
                $indicators);
        }

        return $indicators;
    }

    private static function step_inputs($imet)
    {
        $imet_id = $imet->getKey();

        $indicators = [];
        $indicators['avg_indicator'] = null;
        // TODO

        return $indicators;
    }
    private static function step_process($imet)
    {
        $imet_id = $imet->getKey();

        $indicators = [];
        $indicators['avg_indicator'] = null;
        // TODO

        return $indicators;
    }
    private static function step_outputs($imet)
    {
        $imet_id = $imet->getKey();

        $indicators = [];
        $indicators['avg_indicator'] = null;
        // TODO

        return $indicators;
    }
    private static function step_outcomes($imet)
    {
        $imet_id = $imet->getKey();

        $indicators = [];
        $indicators['avg_indicator'] = null;
        // TODO

        return $indicators;
    }


    private static function eval_management_plan($imet)
    {
        $record = ManagementPlan::where('FormID', $imet)->first();

        $index = null;
        if($record){
            $record = $record->toArray();
            $index = 100 *
                ($record['PlanExistence']
                    + ($record['PlanUptoDate'] ?? 0)
                    + ($record['PlanApproved'] ?? 0)
                    + ($record['PlanImplemented'] ?? 0)
                    + ($record['VisionAdequacy'] ?? 0)
                    + ($record['PlanAdequacyScore'] ?? 0)
                )
//                /  (10 - )
                ;
        }


        return $index;
    }




}