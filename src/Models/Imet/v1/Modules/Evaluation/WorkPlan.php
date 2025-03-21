<?php

namespace ImetCore\Models\Imet\v1\Modules\Evaluation;

use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\User\Role;

class WorkPlan extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_work_plan';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'P5';
        $this->module_title = trans('imet-core::v1_evaluation.WorkPlan.title');
        $this->module_fields = [
            ['name' => 'PlanExistenceScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.WorkPlan.fields.PlanExistenceScore')],
            ['name' => 'PlanApplicationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.WorkPlan.fields.PlanApplicationScore')],
            ['name' => 'PercentageLevel',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.WorkPlan.fields.PercentageLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.WorkPlan.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.WorkPlan.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.WorkPlan.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.WorkPlan.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Eval_WorkPlan',
            'fields' => [
                'PlanExistenceScore', 'PlanApplicationScore', 'PercentageLevel', 'Comments'
            ]
        ];
    }
}
