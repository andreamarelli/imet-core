<?php

namespace AndreaMarelli\ImetCore\Services\Scores;


use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet as ImetOecm;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;
use AndreaMarelli\ImetCore\Services\Scores\Functions\OEMCScores;

class OecmScores
{
    use Labels;

    /**
     * Ensure to return IMET OECM id
     */
    private static function get_as_id(ImetOecm|int|string $imet): int
    {
        return ($imet instanceof ImetOecm)
            ? $imet->getKey()
            : (int) $imet;
    }

    /**
     * Retrieve IMET OECM assessment's scores (all)
     */
    public static function get_all(ImetOecm|int|string $imet): array
    {
        $imet_id = static::get_as_id($imet);
        return OEMCScores::get_scores($imet_id);
    }

    /**
     * Retrieve IMET OECM assessment's radar scores
     */
    public static function get_radar(ImetOecm|int|string $imet): array
    {
        return static::get_all($imet)[_Scores::RADAR_SCORES];
    }

    /**
     * Retrieve IMET assessment's radar scores with abbreviations instead of keys
     */
    public static function get_radar_with_abbreviations(ImetOecm|int|string $imet): array
    {
        $labels = static::labels(Imet::IMET_OECM, true);
        $scores = static::get_all($imet)[_Scores::RADAR_SCORES];
        unset($scores['imet_index']);
        return array_combine($labels, $scores);
    }

    /**
     * Retrieve IMET OECM assessment's given step scores
     */
    public static function get_step(ImetOecm|int|string $imet, string $step): array
    {
        return static::get_all($imet)[$step];
    }

    /**
     * Retrieve the global IMET OECM assessment score
     */
    public static function get_score(ImetOecm|int|string $imet): array
    {
        return static::get_radar($imet)['imet_index'];
    }

    /**
     * Refresh scores (override cache)
     */
    public static function refresh_scores(ImetOecm|int|string $imet): array
    {
        $imet_id = static::get_as_id($imet);
        return OEMCScores::get_scores($imet_id, true);
    }

    /**
     * Retrieve the radar labels
     */
    public static function labels(string $version = Imet::IMET_OECM, bool $only_abbreviations = false): array
    {
        return static::get_labels(Imet::IMET_OECM, $only_abbreviations);
    }

    /**
     * Retrieve the indicators labels
     */
    public static function indicators_labels(string $version = null, bool $only_abbreviations = false): array
    {
        return static::get_indicators_labels($version);
    }

}