<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class BudgetSecurization extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_budget_securization';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'I4';
        $this->module_title = trans('imet-core::form/v1/evaluation.BudgetSecurization.title');
        $this->module_fields = [
            ['name' => 'EvaluationScore',  'type' => 'rating-0to4',   'label' => trans('imet-core::form/v1/evaluation.BudgetSecurization.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('imet-core::form/v1/evaluation.BudgetSecurization.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::form/v1/evaluation.BudgetSecurization.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::form/v1/evaluation.BudgetSecurization.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::form/v1/evaluation.BudgetSecurization.module_info_Rating');
        $this->ratingLegend = trans('imet-core::form/v1/evaluation.BudgetSecurization.ratingLegend');

        parent::__construct($attributes);

    }
}
