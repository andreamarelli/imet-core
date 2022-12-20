<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ModularForms\Helpers\Locale;

abstract class StatisticsService
{
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

    /**
     * Return steps' labels
     *
     * @return array[]
     */
    public static function assessment_steps_labels(): array
    {
        return [
            'v1' => [
                'abbreviations' => ['C', 'P', 'I', 'PR', 'R', 'EI'],
                'full' => [
                    trans('imet-core::v1_common.steps_eval.context'),
                    trans('imet-core::v1_common.steps_eval.planning'),
                    trans('imet-core::v1_common.steps_eval.inputs'),
                    trans('imet-core::v1_common.steps_eval.process'),
                    trans('imet-core::v1_common.steps_eval.outputs'),
                    trans('imet-core::v1_common.steps_eval.outcomes'),
                ]
            ],
            'v2' => [
                'abbreviations' => ['C', 'P', 'I', 'PR', 'OP', 'OC'],
                'full' => [
                    trans('imet-core::v2_common.steps_eval.context'),
                    trans('imet-core::v2_common.steps_eval.planning'),
                    trans('imet-core::v2_common.steps_eval.inputs'),
                    trans('imet-core::v2_common.steps_eval.process'),
                    trans('imet-core::v2_common.steps_eval.outputs'),
                    trans('imet-core::v2_common.steps_eval.outcomes'),
                ]
            ],
        ];
    }


    /**
     * Return indicators's labels
     *
     * @param $version
     * @return array
     */
    public static function labels($version): array
    {
        $labels = [];
        foreach (trans('imet-core::'.$version.'_common.assessment') as $code => $item){
            $labels[$code] = [
                'code_label' => $item[0],
                'title_' . Locale::lower() => $item[1],
            ];
        }
        return $labels;
    }

}