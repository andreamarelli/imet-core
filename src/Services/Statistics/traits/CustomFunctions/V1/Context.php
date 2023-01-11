<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\V1;


use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\ImportanceClassification;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\ImportanceSpecies;

trait Context
{
    protected static function score_c12($imet_id): ?float
    {
        $records = ImportanceClassification::getModuleRecords($imet_id)['records'];

        $values = collect($records)
            ->filter(function ($record){
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0
                    && $record['SignificativeClassification'] !== null;
            });

        $numerator = $values->sum(function ($item){
            return (1 + 2 * $item['SignificativeClassification']) * $item['EvaluationScore'];
        });
        $denominator = $values->sum(function ($item){
            return (1 + 2 * $item['SignificativeClassification']);
        });

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_c13($imet_id): ?float
    {
        $records = ImportanceSpecies::getModuleRecords($imet_id)['records'];

        $values = collect($records)
            ->filter(function ($record){
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0;
            })->map(function ($record){
                $record['SignificativeSpecies'] = $record['SignificativeSpecies']===null
                    ? 0
                    : $record['SignificativeSpecies'];
                return $record;
            });

        $numerator = $values->sum(function ($item){
            return (1 + 2 * $item['SignificativeSpecies']) * $item['EvaluationScore'];
        });
        $denominator = $values->sum(function ($item){
            return (1 + 2 * $item['SignificativeSpecies']);
        });

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_c14($imet_id)
    {
        return null;
    }

    protected static function score_c2($imet_id)
    {
        return null;
    }

    protected static function score_c3($imet_id)
    {
        return null;
    }
}