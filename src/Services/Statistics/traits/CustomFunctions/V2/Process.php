<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\V2;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\ManagementStaff;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\EcosystemServices;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\EquipmentMaintenance;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\GovernanceLeadership;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\StaffCompetence;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\StakeholderCooperation;
use AndreaMarelli\ImetCore\Services\Statistics\V1StatisticsService;

trait Process
{
    protected static function staff_weights($imet_id): array
    {
        $records = ManagementStaff::getModule($imet_id);
        return V1StatisticsService::staff_weights($imet_id, $records);
    }

    protected static function score_pr1($imet_id): ?float
    {
        $staff_weights = static::staff_weights($imet_id);
        $records = StaffCompetence::getModule($imet_id);

        $values = $records
            ->map(function($record) use ($staff_weights){
                $record['eval_score'] = $record['EvaluationScore']!==null ? $record['EvaluationScore'] : $staff_weights[$record['Theme']]['ratio03'];
                $record['weight'] = $record['EvaluationScore']===null ? $staff_weights[$record['Theme']]['w_avg'] : 1;
                return $record;
            });

        $weights = $values->sum('weight');
        $weighted_eval_core = $values->sum(function ($item) {
            return intval($item['eval_score']) * $item['weight'];
        });
        $weighted_percentage = (function($data) {
            $sum = 0;
            foreach ($data as $item){
                if($item['PercentageLevel']===null && $item['weight']===null){
                    $sum += 0;
                }
                else if($item['PercentageLevel']===null || $item['weight']===null){
                    return null;
                } else {
                    $sum += ($item['PercentageLevel'] * $item['weight']);
                }
            }
            return $sum;
        })($values);

        $score = $weights>0 && $weighted_eval_core!==null && $weighted_percentage!==null
            ? 100 / 6 * (($weighted_eval_core + $weighted_percentage) / $weights)
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_pr4($imet_id): ?float
    {
        $records = GovernanceLeadership::getModule($imet_id);

        $sum = null;
        if($records->isNotEmpty()){
            $sum = $records->sum(function ($item) {
                return intval($item['EvaluationScoreGovernace']) +  intval($item['EvaluationScoreLeadership']);
            });
        }

        $score = $sum!==null
            ? $sum / 6 * 100
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_pr6($imet_id): ?float
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

    protected static function score_pr10($imet_id): ?float
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

    protected static function score_pr18($imet_id): ?float
    {
        $records = EcosystemServices::getModule($imet_id);
        $scores = $records->map(function($record) {
            return $record['EvaluationScore'] === "-99" ? null : $record['EvaluationScore'];
        });

        $score = $scores->isNotEmpty()
            ? static::average($scores, null) * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }
}