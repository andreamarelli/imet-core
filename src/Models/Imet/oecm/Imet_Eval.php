<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\BoundaryLevel;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\BudgetAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\BudgetSecurization;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\CapacityAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\DesignAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Designation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\InformationAvailability;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\KeyElements;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementEquipmentAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementPlan;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Objectives;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesIntrants;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesKeyElements;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesPlanification;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesProcessus;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ObjectivesSupportsAndConstraints;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\RegulationsAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\SupportsAndConstraints;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\WorkPlan;

class Imet_Eval extends Imet
{

    public static $modules = [
        'context' => [
            Designation::class,
            KeyElements::class,
            ObjectivesKeyElements::class,
            SupportsAndConstraints::class,
            ObjectivesSupportsAndConstraints::class
        ],
        'planning' => [
            RegulationsAdequacy::class,
            DesignAdequacy::class,
            BoundaryLevel::class,
            ManagementPlan::class,
            WorkPlan::class,
            Objectives::class,
            ObjectivesPlanification::class
        ],
        'inputs' => [
            InformationAvailability::class,
            CapacityAdequacy::class,
            BudgetAdequacy::class,
            BudgetSecurization::class,
            ManagementEquipmentAdequacy::class,
            ObjectivesIntrants::class
        ],
        'process' => [
            ObjectivesProcessus::class
        ],
        'outputs' => [],
        'outcomes' => [],
        'management_effectiveness' => [],
    ];

}
