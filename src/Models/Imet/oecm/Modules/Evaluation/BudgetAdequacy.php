<?php

namespace ImetCore\Models\Imet\oecm\Modules\Evaluation;

use ImetCore\Models\Imet\oecm\Modules;
use ImetCore\Models\User\Role;

class BudgetAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_budget_adequacy';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'I3';
        $this->module_title = trans('imet-core::oecm_evaluation.BudgetAdequacy.title');
        $this->module_fields = [
            ['name' => 'EvaluationScore',  'type' => 'rating-0to5',   'label' => trans('imet-core::oecm_evaluation.BudgetAdequacy.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.BudgetAdequacy.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.BudgetAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.BudgetAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.BudgetAdequacy.ratingLegend');

        parent::__construct($attributes);

    }

}
