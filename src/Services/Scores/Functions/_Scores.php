<?php

namespace AndreaMarelli\ImetCore\Services\Scores\Functions;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet as ImetOEMC;
use AndreaMarelli\ModularForms\Helpers\Locale;
use AndreaMarelli\ModularForms\Models\Cache;

abstract class _Scores
{
    use Math;

    const CACHE_PREFIX = 'imet_scores';

    const RADAR_SCORES = 'global';
    const ALL_SCORES = 'ALL';

    const CONTEXT = 'context';
    const PLANNING = 'planning';
    const INPUTS = 'inputs';
    const PROCESS = 'process';
    const OUTPUTS = 'outputs';
    const OUTCOMES = 'outcomes';

    /**
     * Ensure to return IMET model
     */
    public static function get_as_model(Imet|ImetOEMC|int|string $imet): Imet|ImetOEMC
    {
        if(is_int($imet) or is_string($imet)){
            $imet = Imet::find($imet);
        }
        return $imet;
    }

    /**
     * Calculate all assessment scores
     */
    private static function calculate_scores(int $imet_id): array
    {
        // Granular scores per each step
        $scores = [
            static::CONTEXT => static::scores_context($imet_id),
            static::PLANNING => static::scores_planning($imet_id),
            static::INPUTS => static::scores_inputs($imet_id),
            static::PROCESS => static::scores_process($imet_id),
            static::OUTPUTS => static::scores_outputs($imet_id),
            static::OUTCOMES => static::scores_outcomes($imet_id),
        ];

        // Overall steps scores
        $scores[self::RADAR_SCORES] = [
            static::CONTEXT => $scores[static::CONTEXT]['avg_indicator'],
            static::PLANNING => $scores[static::PLANNING]['avg_indicator'],
            static::INPUTS => $scores[static::INPUTS]['avg_indicator'],
            static::PROCESS => $scores[static::PROCESS]['avg_indicator'],
            static::OUTPUTS => $scores[static::OUTPUTS]['avg_indicator'],
            static::OUTCOMES =>  $scores[static::OUTCOMES]['avg_indicator']
        ];

        // Overall IMET score
        $scores[self::RADAR_SCORES]['imet_index'] = static::average([
            $scores[self::RADAR_SCORES][static::CONTEXT],
            $scores[self::RADAR_SCORES][static::PLANNING],
            $scores[self::RADAR_SCORES][static::INPUTS],
            $scores[self::RADAR_SCORES][static::PROCESS],
            $scores[self::RADAR_SCORES][static::OUTPUTS],
            $scores[self::RADAR_SCORES][static::OUTCOMES],
        ]);

        return $scores;
    }

    public static function get_scores_2(int $imet_id, bool $refresh_cache = false): array
    {
        // Retrieve scores from cache
        $cache_key = Cache::buildKey(self::CACHE_PREFIX, ['id' => $imet_id]);
        if (!$refresh_cache && ($cache_value = Cache::get($cache_key)) !== null) {
            $scores = $cache_value;
        }
        // Calculate scores and store in cache
        else {
            $scores = static::calculate_scores($imet_id);
            Cache::put($cache_key, $scores, null);
        }
        return $scores;
    }

    /**
     * Retrieve assessment's scores
     */
    public static function get_scores(Imet|ImetOEMC|int|string $imet, string $step = self::RADAR_SCORES, bool $cache = true): array
    {
        $imet = static::get_as_model($imet);
        $imet_id = $imet->getKey();

        // Retrieve scores from cache
        $cache_key = Cache::buildKey(self::CACHE_PREFIX, ['id' => $imet_id]);
        if ($cache && ($cache_value = Cache::get($cache_key)) !== null) {
            $scores = $cache_value;
        }
        // Calculate scores and store in cache
        else {
            $scores = static::calculate_scores($imet_id);
            Cache::put($cache_key, $scores, null);
        }

        return $step === static::ALL_SCORES
            ? $scores
            : $scores[$step];
    }

    /**
     * Retrieve assessment's scores with labels (for radar)
     */
    public static function get_radar_scores(Imet|ImetOEMC|int|string $imet): array
    {
        $imet = static::get_as_model($imet);

        $labels = static::steps_labels()[$imet->version]['abbreviations'];
        $scores = static::get_scores($imet);
        unset($scores['imet_index']);

        return array_combine($labels, $scores);
    }

    /**
     * Retrieve IMET assessment information including scores
     */
    public static function get_assessment(Imet|ImetOEMC|int|string $imet, string $step = self::RADAR_SCORES): array
    {
        $imet = static::get_as_model($imet);
        return array_merge(
            [
                'formid' => $imet->getKey(),
                'wdpa_id' => $imet->wdpa_id,
                'iso3' => $imet->Country,
                'name' => $imet->name,
                'version' => $imet->version,
                'labels' => static::indicators_labels($imet->version)
                ],
            static::get_scores($imet, $step)
        );
    }

    /**
     * Return steps' labels
     *
     * @return array[]
     */
    public static function steps_labels(): array
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


    /**
     * Return indicator's labels
     *
     * @param $version
     * @return array
     */
    public static function indicators_labels($version): array
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
