<?php

namespace AndreaMarelli\ImetCore\Services\Scores;


use AndreaMarelli\ImetCore\Models\Imet\Imet;

trait Labels{

    protected static function get_labels(string $version = null, $only_abbreviations = false): array
    {
        $labels = static::all_labels();

        if($version !== null){
            $labels = $labels[$version];
            if($only_abbreviations){
                $labels = $labels['abbreviations'];
            }
        }

        return $labels;
    }

    private static function all_labels(): array
    {
        return [
            Imet::IMET_V1 => [
                'abbreviations' => ['C', 'P', 'I', 'PR', 'R', 'EI'],
                'full' => [
                    trans('imet-core::common.steps_eval.context'),
                    trans('imet-core::common.steps_eval.planning'),
                    trans('imet-core::common.steps_eval.inputs'),
                    trans('imet-core::common.steps_eval.process'),
                    trans('imet-core::common.steps_eval.outputs'),
                    trans('imet-core::common.steps_eval.outcomes'),
                ]
            ],
            Imet::IMET_V2 => [
                'abbreviations' => ['C', 'P', 'I', 'PR', 'OP', 'OC'],
                'full' => [
                    trans('imet-core::common.steps_eval.context'),
                    trans('imet-core::common.steps_eval.planning'),
                    trans('imet-core::common.steps_eval.inputs'),
                    trans('imet-core::common.steps_eval.process'),
                    trans('imet-core::common.steps_eval.outputs'),
                    trans('imet-core::common.steps_eval.outcomes'),
                ]
            ],
            Imet::IMET_OECM => [
                'abbreviations' => ['C', 'P', 'I', 'PR', 'OP', 'OC'],
                'full' => [
                    trans('imet-core::common.steps_eval.context'),
                    trans('imet-core::common.steps_eval.planning'),
                    trans('imet-core::common.steps_eval.inputs'),
                    trans('imet-core::common.steps_eval.process'),
                    trans('imet-core::common.steps_eval.outputs'),
                    trans('imet-core::common.steps_eval.outcomes'),
                ]
            ],
        ];
    }

}