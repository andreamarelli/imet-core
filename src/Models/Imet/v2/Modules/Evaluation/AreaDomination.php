<?php

namespace ImetCore\Models\Imet\v2\Modules\Evaluation;

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

class AreaDomination extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_area_domination';

    public const MODULE_SCOPE = self::TERRESTRIAL_AND_MARINE;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'O/P3';
        $this->module_title = trans('imet-core::v2_evaluation.AreaDomination.title');
        $this->module_fields = [
            ['name' => 'Patrol',            'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.AreaDomination.fields.Patrol')],
            ['name' => 'RapidIntervention', 'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.AreaDomination.fields.RapidIntervention')],
            ['name' => 'AirVehicles',       'type' => 'toggle-yes_no',   'label' => trans('imet-core::v2_evaluation.AreaDomination.fields.AirVehicles')],
            ['name' => 'Planes',            'type' => 'toggle-yes_no',   'label' => trans('imet-core::v2_evaluation.AreaDomination.fields.Planes')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AreaDomination.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.AreaDomination.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.AreaDomination.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.AreaDomination.ratingLegend');

        parent::__construct($attributes);

    }
}
