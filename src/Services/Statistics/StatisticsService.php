<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet as ImetOEMC;
use AndreaMarelli\ImetCore\Services\Statistics\traits\Math;
use AndreaMarelli\ModularForms\Helpers\Locale;
use AndreaMarelli\ModularForms\Models\Cache;

abstract class StatisticsService
{
    use Math;

    const CACHE_PREFIX = 'imet_scores';

    const GLOBAL = 'global';

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
    private static function getCacheKey(Imet|ImetOEMC|int|string $imet, string $step): string
    {
        $imet_id = ($imet instanceof ImetOEMC or $imet instanceof Imet)
            ? $imet['FormID']
            : $imet;
        return Cache::buildKey(self::CACHE_PREFIX, ['id' => $imet_id, 'step' => $step]);
    }

    /**
     * Retrieve assessment's scores
     */
    public static function get_scores(Imet|ImetOEMC|int|string $imet, string $step = self::GLOBAL, bool $cache = true): array
    {
        // Retrieve from cache
        $cache_key = static::getCacheKey($imet, $step);
        if ($cache && ($cache_value = Cache::get($cache_key)) !== null) {
            return $cache_value;
        }

        $imet = static::get_imet($imet);

        switch ($step) {
            case static::GLOBAL:
                $scores = [
                    static::CONTEXT => static::scores_context($imet)['avg_indicator'],
                    static::PLANNING => static::scores_planning($imet)['avg_indicator'],
                    static::INPUTS => static::scores_inputs($imet)['avg_indicator'],
                    static::PROCESS => static::scores_process($imet)['avg_indicator'],
                    static::OUTPUTS => static::scores_outputs($imet)['avg_indicator'],
                    static::OUTCOMES => static::scores_outcomes($imet)['avg_indicator'],
                ];
                $scores['imet_index'] = static::average($scores);
                break;
            case self::CONTEXT:
                $scores = static::scores_context($imet);
                break;
            case self::PLANNING:
                $scores = static::scores_planning($imet);
                break;
            case self::INPUTS:
                $scores = static::scores_inputs($imet);
                break;
            case self::PROCESS:
                $scores = static::scores_process($imet);
                break;
            case self::OUTPUTS:
                $scores = static::scores_outputs($imet);
                break;
            case self::OUTCOMES:
                $scores = static::scores_outcomes($imet);
                break;
            case "ALL":
                $scores = [
                    static::GLOBAL => static::get_scores($imet),
                    static::CONTEXT => static::get_scores($imet, StatisticsService::CONTEXT),
                    static::PLANNING => static::get_scores($imet, StatisticsService::PLANNING),
                    static::INPUTS => static::get_scores($imet, StatisticsService::INPUTS),
                    static::PROCESS => static::get_scores($imet, StatisticsService::PROCESS),
                    static::OUTPUTS => static::get_scores($imet, StatisticsService::OUTPUTS),
                    static::OUTCOMES => static::get_scores($imet, StatisticsService::OUTCOMES),
                ];
            default:
                $scores = [];
        }

        Cache::put($cache_key, $scores, null);

        return $scores;
    }

    /**
     * Retrieve assessment's scores (for radar)
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
    public static function get_assessment(Imet|ImetOEMC|int|string $imet, string $step = self::GLOBAL): array
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
     * Return indicators's labels
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
