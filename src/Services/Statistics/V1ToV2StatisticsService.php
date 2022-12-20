<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\Statistics\StatisticsService;

class V1ToV2StatisticsService extends StatisticsService
{

    public static function get_scores(Imet $imet_id, string $step = 'global'): array
    {
        $stats = [
            'context' => null,
            'planning' => null,
            'inputs' => null,
            'process' => null,
            'outputs' => null,
            'outcomes' => null,
            'imet_index' => null,
        ];


        if($step === 'global'){

        }
        return $stats;
    }

}