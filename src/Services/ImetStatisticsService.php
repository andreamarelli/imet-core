<?php

namespace AndreaMarelli\ImetCore\Services;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ModularForms\Helpers\Locale;

class ImetStatisticsService
{

    public static function assessment(int $imet_id, string $step = 'global', bool $labels = false): array
    {
        $imet = Imet::find($imet_id);

        if($imet->version === 'v1'){
            /** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Imet $imet */
            $stats = ImetV1toV2StatisticsService::get_scores($imet, $step);
        } else {
            /** @var \AndreaMarelli\ImetCore\Models\Imet\v2\Imet $imet */
            $stats = ImetV2StatisticsService::get_scores($imet, $step);
        }

        return array_merge([
            'formid' => $imet->getKey(),
            'wdpa_id' => $imet->wdpa_id,
            'year' => $imet->Year,
            'iso3' => $imet->Country,
            'name' => $imet->name,
            'version' => $imet->version,
            'labels' => $labels ? static::labels($imet->version) : null,
           ],
   $stats);
    }

    public static function radar_assessment(int $imet_id, $abbreviations = true)
    {
        $stats = static::assessment($imet_id, 'global', true);
        $values = [
            $stats["context"],
            $stats["planning"],
            $stats["inputs"],
            $stats["process"],
            $stats["outputs"],
            $stats["outcomes"]
        ];

        $labels = static::assessment_steps_labels()[$stats['version']][$abbreviations ? 'abbreviations' : 'full'];
        return array_combine($labels, $values);
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