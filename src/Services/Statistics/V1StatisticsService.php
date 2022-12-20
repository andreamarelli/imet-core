<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\Statistics\traits\DBFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\Math;
use AndreaMarelli\ImetCore\Services\Statistics\StatisticsService;

class V1StatisticsService extends StatisticsService
{
    use DBFunctions;
    use Math;

}