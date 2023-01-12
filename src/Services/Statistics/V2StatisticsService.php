<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Services\Statistics\traits\DB\DBFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\DB\V2_DBFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\Math;


class V2StatisticsService extends StatisticsService
{
    use DBFunctions;
    use V2_DBFunctions;
    use Math;

    const SCHEMA = 'imet_assessment_v2'; // todo: to be removed after conversion to PHP

    public static function scores_context($imet): array
    {
        return ['avg_indicator' => null];
    }
    public static function scores_planning($imet): array
    {
        return ['avg_indicator' => null];
    }
    public static function scores_inputs($imet): array
    {
        return ['avg_indicator' => null];
    }
    public static function scores_process($imet): array
    {
        return ['avg_indicator' => null];
    }
    public static function scores_outputs($imet): array
    {
        return ['avg_indicator' => null];
    }
    public static function scores_outcomes($imet): array
    {
        return ['avg_indicator' => null];
    }
}