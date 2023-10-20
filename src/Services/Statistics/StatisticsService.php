<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet as ImetOEMC;
use AndreaMarelli\ImetCore\Services\Statistics\traits\Math;
use AndreaMarelli\ModularForms\Helpers\Locale;
use AndreaMarelli\ModularForms\Models\Cache;
use Illuminate\Support\Facades\Log;

abstract class StatisticsService
{
    use Math;

    const CACHE_PREFIX = 'imet_scores';

    const SUMMARY_SCORES = 'global';
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
    protected static function get_imet(Imet|ImetOEMC|int|string $imet): Imet|ImetOEMC
    {
        if(is_int($imet) or is_string($imet)){
            $imet = Imet::find($imet);
        }
        return $imet;
    }

    /**
     * Generate cache key
     */
    private static function getCacheKey(Imet|ImetOEMC|int|string $imet): string
    {
        $imet_id = ($imet instanceof ImetOEMC or $imet instanceof Imet)
            ? $imet['FormID']
            : $imet;
        return Cache::buildKey(self::CACHE_PREFIX, ['id' => $imet_id]);
    }

    /**
     * Calculate scores
     */
    public static function calculate_scores(Imet|ImetOEMC|int|string $imet): array
    {
        $imet = static::get_imet($imet);

        // Granular scores per each step
        $scores = [
            static::CONTEXT => static::scores_context($imet),
            static::PLANNING => static::scores_planning($imet),
            static::INPUTS => static::scores_inputs($imet),
            static::PROCESS => static::scores_process($imet),
            static::OUTPUTS => static::scores_outputs($imet),
            static::OUTCOMES => static::scores_outcomes($imet),
        ];

        // Overall steps scores
        $scores[self::SUMMARY_SCORES] = [
            static::CONTEXT => $scores[static::CONTEXT]['avg_indicator'],
            static::PLANNING => $scores[static::PLANNING]['avg_indicator'],
            static::INPUTS => $scores[static::INPUTS]['avg_indicator'],
            static::PROCESS => $scores[static::PROCESS]['avg_indicator'],
            static::OUTPUTS => $scores[static::OUTPUTS]['avg_indicator'],
            static::OUTCOMES =>  $scores[static::OUTCOMES]['avg_indicator']
        ];

        // Overall IMET score
        $scores[self::SUMMARY_SCORES]['imet_index'] = static::average([
            $scores[self::SUMMARY_SCORES][static::CONTEXT],
            $scores[self::SUMMARY_SCORES][static::PLANNING],
            $scores[self::SUMMARY_SCORES][static::INPUTS],
            $scores[self::SUMMARY_SCORES][static::PROCESS],
            $scores[self::SUMMARY_SCORES][static::OUTPUTS],
            $scores[self::SUMMARY_SCORES][static::OUTCOMES],
        ]);

        return $scores;
    }

    /**
     * Retrieve assessment's scores
     */
    public static function get_scores(Imet|ImetOEMC|int|string $imet, string $step = self::SUMMARY_SCORES, bool $cache = true): array
    {
        // Retrieve scores from cache
        $cache_key = static::getCacheKey($imet);
        if ($cache && ($cache_value = Cache::get($cache_key)) !== null) {
            $scores = $cache_value;
        }
        // Calculate scores and store in cache
        else {
            $scores = static::calculate_scores($imet);
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
        $imet = static::get_imet($imet);

        $labels = static::steps_labels();
        $scores = static::get_scores($imet);
        unset($scores['imet_index']);

        return array_combine(
            $labels[$imet->version]['abbreviations'],
            $scores
        );
    }

    /**
     * Retrieve the global IMET score
     */
    public static function get_imet_score(Imet|ImetOEMC|int|string $imet): ?float
    {
        return static::get_scores($imet)['imet_index'];
    }

    /**
     * Retrieve IMET assessment information including scores
     */
    public static function get_assessment(Imet|ImetOEMC|int|string $imet, string $step = self::SUMMARY_SCORES): array
    {
        $imet = static::get_imet($imet);
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
