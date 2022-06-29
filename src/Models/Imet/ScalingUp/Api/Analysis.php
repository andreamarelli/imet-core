<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Api;

use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Api\Analysis\Average;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Api\Analysis\Data;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Api\Analysis\DataUpperLowerAverage;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Api\Analysis\Ranking;

trait Analysis
{
    use Ranking;
    use Data;
    use Average;
    use DataUpperLowerAverage;
}
