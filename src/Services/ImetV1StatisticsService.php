<?php

namespace AndreaMarelli\ImetCore\Services;

use AndreaMarelli\ImetCore\Models\Imet\Imet;

class ImetV1StatisticsService extends ImetStatisticsService
{

    public static function get_index(Imet $imet_id, string $step = 'global'): array
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