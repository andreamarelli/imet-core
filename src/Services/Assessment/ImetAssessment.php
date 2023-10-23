<?php

namespace AndreaMarelli\ImetCore\Services\Assessment;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet as ImetV1;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet as ImetV2;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;
use AndreaMarelli\ImetCore\Services\Scores\ImetScores;
use AndreaMarelli\ImetCore\Services\Scores\Labels;

class ImetAssessment
{
    use Labels;

    /**
     * Ensure to return IMET model
     */
    private static function get_as_model(Imet|ImetV1|ImetV2|int|string $imet): Imet
    {
        return (is_int($imet) or is_string($imet))
            ? Imet::find($imet)
            : $imet;
    }

    /**
     * Retrieve IMET info and scores
     */
    public static function get_assessment(Imet|ImetV1|ImetV2|int|string $imet, $step = _Scores::RADAR_SCORES): array
    {
        $imet = static::get_as_model($imet);
        $scores = $step === _Scores::ALL_SCORES
            ? ImetScores::get_all($imet)
            : (
                $step == _Scores::RADAR_SCORES
                    ? ImetScores::get_radar($imet)
                    : ImetScores::get_step($imet, $step)
            );
        return array_merge(
            [
                'formid' => $imet->getKey(),
                'wdpa_id' => $imet->wdpa_id,
                'iso3' => $imet->Country,
                'name' => $imet->name,
                'version' => $imet->version,
                'labels' => static::get_indicators_labels($imet->version),
            ],
            $scores
        );
    }

    /**
     * Retrieve the number of assessment and the related WDPA IDs for the given country
     */
    public static function get_assessment_by_country($country): array
    {
        return Imet::select(['FormID', 'wdpa_id', 'Country', 'Year', 'name', 'language'])
            ->where('Country', $country)
            ->orderBy('Year', 'DESC')
            ->get()
            ->toArray();
    }

}