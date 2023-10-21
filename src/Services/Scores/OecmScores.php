<?php

namespace AndreaMarelli\ImetCore\Services\Scores;


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
        return OEMCScores::get_scores_2($imet_id);
    }

    /**
     * Retrieve IMET OECM assessment's radar scores
     */
    public static function get_radar(ImetOecm|int|string $imet): array
    {
        $imet_id = static::get_as_id($imet);
        $scores = OEMCScores::get_scores_2($imet_id);
        return $scores[_Scores::RADAR_SCORES];
    }

    /**
     * Retrieve IMET OECM assessment's given step scores
     */
    public static function get_step(ImetOecm|int|string $imet, string $step): array
    {
        $imet_id = static::get_as_id($imet);
        $scores = OEMCScores::get_scores_2($imet_id);
        return $scores[$step];
    }

    /**
     * Refresh scores (override cache)
     */
    public static function refresh_scores(ImetOecm|int|string $imet): array
    {
        $imet_id = static::get_as_id($imet);
        return OEMCScores::get_scores_2($imet_id, true);
    }

    /**
     * Retrieve the radar labels
     */
    public static function labels(string $version = null, bool $only_abbreviations = false): array
    {
        return static::get_labels($version, $only_abbreviations);
    }

}