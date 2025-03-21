<?php

namespace ImetCore\Models\Imet\v2\Modules\Evaluation;

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

class AchievedResults extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_achieved_results';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'O/P2';
        $this->module_title = trans('imet-core::v2_evaluation.AchievedResults.title');
        $this->module_fields = [
            ['name' => 'Category',          'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AchievedResults.fields.Category')],
            ['name' => 'Activity',          'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AchievedResults.fields.Activity')],
            ['name' => 'TargetedOutput',    'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AchievedResults.fields.TargetedOutput')],
            ['name' => 'EvaluationScore',   'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.AchievedResults.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.AchievedResults.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.AchievedResults.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.AchievedResults.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.AchievedResults.ratingLegend');

        parent::__construct($attributes);

    }
}
