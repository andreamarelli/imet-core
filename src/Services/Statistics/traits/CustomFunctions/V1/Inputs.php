<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\V1;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\ManagementStaff;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\BudgetAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\BudgetSecurization;

trait Inputs
{

    protected static function staff_weights($imet_id): array
    {
        $records = ManagementStaff::getModuleRecords($imet_id)['records'];

        return collect($records)
            ->map(function($record){
                $ratio = min(1,
                    ($record['ActualPermanent'] ?? 0) / ($record['ExpectedPermanent']=="0" ? null : $record['ExpectedPermanent'])
                );
                $record['ratio03'] = $ratio===0
                    ? 0
                    : ($ratio>0
                        ? ceil($ratio * 4 -1)
                        : null);
                $record['w_avg'] = 1 + log($record['ExpectedPermanent']=="0" ? null : $record['ExpectedPermanent']);
                return $record;
            })
            ->keyBy('Function')
            ->map(function($record){
                return collect($record)->only(['ratio03', 'w_avg']);
            })
            ->toArray();
    }


    protected static function score_i2($imet_id)
    {
        return null;
    }
    protected static function score_i3($imet_id)
    {
        $records = BudgetAdequacy::getModuleRecords($imet_id)['records'];

        $value = $records!==null
            ? (int) $records[0]['EvaluationScore']
            : null;

        if($value===1){
            $score = 17.5;
        } elseif($value===2){
            $score = 53;
        } elseif($value===3){
            $score = 85.5;
        } elseif($value===4){
            $score = 100;
        } else {
            $score = null;
        }
        return $score;
    }

    protected static function score_i4($imet_id)
    {
        $records = BudgetSecurization::getModuleRecords($imet_id)['records'];

        $value = $records!==null
            ? (int) $records[0]['EvaluationScore']
            : null;

        if($value===1){
            $score = 16.7;
        } elseif($value===2){
            $score = 50;
        } elseif($value===3){
            $score = 83.3;
        } elseif($value===4){
            $score = 100;
        } else {
            $score = null;
        }
        return $score;
    }

    protected static function score_i5($imet_id)
    {
        return null;
    }
}