<?php

namespace ImetCore\Models\Imet\v2\Modules\Evaluation;

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

class EnvironmentalEducation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_actors_relations';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR12';
        $this->module_title = trans('imet-core::v2_evaluation.EnvironmentalEducation.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.EnvironmentalEducation.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.EnvironmentalEducation.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.EnvironmentalEducation.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => trans('imet-core::v2_evaluation.EnvironmentalEducation.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.EnvironmentalEducation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.EnvironmentalEducation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.EnvironmentalEducation.ratingLegend');

        parent::__construct($attributes);

    }
}
