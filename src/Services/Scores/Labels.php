<?php

namespace AndreaMarelli\ImetCore\Services\Scores;

use AndreaMarelli\ImetCore\Models\Imet;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;
use AndreaMarelli\ModularForms\Helpers\Locale;

trait Labels{

    protected static function get_labels(string $version = null, $only_abbreviations = false, $with_keys = false): array
    {
        $labels = static::all_labels();

        if($version !== null){
            $labels = $labels[$version];
            if($only_abbreviations){
                $labels = $labels['abbreviations'];
            }
        }
        if($with_keys){
            $labels['full'] = array_combine(
                [_Scores::CONTEXT, _Scores::PLANNING, _Scores::INPUTS, _Scores::PROCESS, _Scores::OUTPUTS, _Scores::OUTCOMES],
                $labels['full']);
        }

        return $labels;
    }

    private static function all_labels(): array
    {
        return [
            Imet\Imet::IMET_V1 => [
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
            Imet\Imet::IMET_V2 => [
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
            Imet\Imet::IMET_OECM => [
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

    /**
     * Return indicator's labels
     */
    public static function get_indicators_labels(string $version): array
    {
        $labels = [];
        foreach (trans('imet-core::'.$version.'_common.assessment') as $code => $item){
            $labels[$code] = [
                'code_label' => $item[0],
                'title_' . Locale::lower() => $item[1],
            ];
        }
        return array_merge(
            $labels,
            static::get_labels($version, false, true)['full']
        );
    }

}