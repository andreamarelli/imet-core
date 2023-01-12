<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\V2;

use AndreaMarelli\ImetCore\Services\Statistics\V1StatisticsService;

trait Context
{
    protected static function score_c11($imet_id)
    {
        return V1StatisticsService::score_c12($imet_id);
    }
    protected static function score_c12($imet_id)
    {
        return V1StatisticsService::score_c13($imet_id);
    }
    protected static function score_c13($imet_id)
    {
        return V1StatisticsService::score_c14($imet_id);
    }
    protected static function score_c15($imet_id)
    {
        return null;
    }
    protected static function score_c2($imet_id)
    {
        return V1StatisticsService::score_c2($imet_id);
    }
    protected static function score_c3($imet_id)
    {
        return V1StatisticsService::score_c2($imet_id);
    }
}