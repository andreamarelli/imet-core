<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\BudgetSecurization;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\GovernanceLeadership;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\ManagementPlan;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\WorkPlan;
use AndreaMarelli\ImetCore\Services\Statistics\traits\DB\DBFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\Math;


class V2StatisticsService extends StatisticsService
{
    use DBFunctions;
    use Math;

    const SCHEMA = 'imet_assessment_v2'; // todo: to be removed after conversion to PHP

    /**
     * Return CONTEXT step scores
     *
     * @param $imet
     * @return array
     */
    protected static function scores_context($imet): array
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

        // aggregate step score
        $sum = ($scores['c1'] ?? 0)
            + ($scores['c2'] ? $scores['c2']/2+50 : 0)
            + ($scores['c3'] ? $scores['c3']+100 : 0);
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
    protected static function scores_planning($imet): array
    {
        $imet_id = $imet->getKey();

        $scores = [
            'p1' => static::table_db_function($imet_id, 'eval_regulations_adequacy', 'EvaluationScore'),
            'p2' => static::table_db_function($imet_id, 'eval_design_adequacy', 'EvaluationScore'),
            'p3' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_p3', 'eval_boundary_level_v2'),
            'p4' => static::score_management_and_work_plans($imet_id, ManagementPlan::class),
            'p5' => static::score_management_and_work_plans($imet_id, WorkPlan::class),
            'p6' => static::table_db_function($imet_id, 'eval_objectives', 'EvaluationScore'),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        return $scores;
    }

    /**
     * Return INPUTS step scores
     *
     * @param $imet
     * @return array
     */
    protected static function scores_inputs($imet): array
    {
        $imet_id = $imet->getKey();

        $scores = [
            'i1' => static::group_db_function($imet_id, 'eval_information_availability', 'EvaluationScore', 'group_key'),
            'i2' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_i2', 'eval_staff', ['EvaluationScore']),
            'i3' => static::rank_db_function($imet_id, 'eval_budget_adequacy', 'EvaluationScore', 'EVAL I3'),
            'i4' => static::score_budget_securization($imet_id),
            'i5' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_i5', 'eval_management_equipment_adequacy', ['Importance']),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        return $scores;
    }

    /**
     * Return PROCESS step scores
     *
     * @param $imet
     * @return array
     */
    protected static function scores_process($imet): array
    {
        $imet_id = $imet->getKey();

        $scores = [
            'pr1' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_pr1', 'eval_staff_competence', ['EvaluationScore']),
            'pr2' => static::table_db_function($imet_id, 'eval_hr_management_politics', 'EvaluationScore'),
            'pr3' => static::table_db_function($imet_id, 'eval_hr_management_systems', 'EvaluationScore'),
            'pr4' => static::score_governance_leadership($imet_id),
            'pr5' => static::table_db_function($imet_id, 'eval_administrative_management', 'EvaluationScore', 'get_imet_evaluation_stats_table_all_4'),
            'pr6' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_pr6', 'eval_equipment_maintenance', ['EvaluationScore']),
            'pr7' => static::group_db_function($imet_id, 'eval_management_activities', 'EvaluationScore', 'group_key'),
            'pr8' => static::table_db_function($imet_id, 'eval_law_enforcement_implementation', 'Adequacy'),
            'pr9' => static::group_db_function($imet_id, 'eval_intelligence_implementation', 'Adequacy', 'group_key', 'get_imet_evaluation_stats_group_all_fix'),
            'pr10' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_pr10', 'eval_stakeholder_cooperation', ['Cooperation', 'group_key']),
            'pr11' => static::group_db_function($imet_id, 'eval_assistance_activities', 'EvaluationScore', 'group_key', 'get_imet_evaluation_stats_group_all_fix'),
            'pr12' => static::table_db_function($imet_id, 'eval_actors_relations', 'EvaluationScore'),
            'pr13' => static::group_db_function($imet_id,  'eval_visitors_management', 'EvaluationScore', 'group_key'),
            'pr14' => static::group_db_function($imet_id, 'eval_visitors_impact', 'EvaluationScore', 'group_key'),
            'pr15' => static::table_db_function($imet_id, 'eval_natural_resources_monitoring', 'EvaluationScore'),
            'pr16' => static::table_db_function($imet_id, 'eval_research_and_monitoring', 'EvaluationScore'),
            'pr17' => static::table_db_function($imet_id, 'eval_climate_change_monitoring', 'EvaluationScore'),
            'pr18' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_pr18', 'eval_ecosystem_services', ['EvaluationScore', 'group_key', 'spam']),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        // intermediate scores
        $scores['pr1_6'] = static::average([$scores['pr1'],  $scores['pr2'], $scores['pr3'], $scores['pr4'], $scores['pr5'], $scores['pr6']]);
        $scores['pr7_9'] = static::average([$scores['pr7'],  $scores['pr8'],  $scores['pr9']]);
        $scores['pr10_12'] = static::average([$scores['pr10'],  $scores['pr11'],  $scores['pr12']]);
        $scores['pr13_14'] = static::average([$scores['pr13'],  $scores['pr14']]);
        $scores['pr15_16'] = static::average([$scores['pr15'],  $scores['pr16']]);
        $scores['pr17_18'] = static::average([$scores['pr17'],  $scores['pr18']]);

        return $scores;
    }

    /**
     * Return OUPUTS step scores
     *
     * @param $imet
     * @return array
     */
    protected static function scores_outputs($imet): array
    {
        $imet_id = $imet->getKey();

        $scores = [
            'op1' => static::table_db_function($imet_id, 'eval_work_program_implementation', 'EvaluationScore'),
            'op2' => static::table_db_function($imet_id, 'eval_achieved_results', 'EvaluationScore'),
            'op3' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_op3', 'eval_area_domination'),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 2);

        return $scores;
    }

    /**
     * Return OUTCOMES step scores
     *
     * @param $imet
     * @return array
     */
    protected static function scores_outcomes($imet): array
    {
        $imet_id = $imet->getKey();

        $scores = [
            'oc1' => static::table_db_function($imet_id, 'eval_achived_objectives', 'EvaluationScore'),
            'oc2' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_oc2', 'eval_key_conservation_trends', ['Condition', 'Trend']),
            'oc3' => static::group_db_function($imet_id, 'eval_life_quality_impact', 'EvaluationScore', 'group_key'),
        ];

        // aggregate step score
        $sum = ($scores['oc1'] ?? 0)
            + ($scores['oc2'] ? $scores['oc2']/2+50 : 0)
            + ($scores['oc3'] ? $scores['oc3']/2+50 : 0);
        $count = count(array_filter([$scores['oc1'], $scores['oc2'], $scores['oc3']], function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

    /**
     * Custom score function for ManagementPlan and WorkPlan
     *
     * @param $imet
     * @param $module_class
     * @return float|int|null
     */
    private static function score_management_and_work_plans($imet, $module_class)
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

    /**
     * Custom score function for BudgetSecurization
     *
     * @param $imet
     * @return float|int|null
     */
    private static function score_budget_securization($imet)
    {
        $record = BudgetSecurization::where('FormID', $imet)->first();

        $score = null;
        if($record && $record['Percentage']!==null && $record['EvaluationScore'] !== null){
            $score = (($record['Percentage'] / 5) + ( $record['EvaluationScore'] / 3 )) / 2 * 100;
            $score = round($score, 2);
        }
        return $score;
    }

    /**
     * Custom score function for GovernanceLeadership
     *
     * @param $imet
     * @return float|int|null
     */
    private static function score_governance_leadership($imet)
    {
        $record = GovernanceLeadership::where('FormID', $imet)->first();

        $score = null;
        // (eval_governance_leadership."EvaluationScoreGovernace" + eval_governance_leadership."EvaluationScoreLeadership") / 6.0 * 100.0 AS value_p
        if($record){
            $score = ($record['EvaluationScoreGovernace'] + $record['EvaluationScoreLeadership']) / 6.0 * 100.0;
            $score = round($score, 2);
        }
        return $score;
    }

}