<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class BudgetAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_budget_adequacy';

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'I3';
        $this->module_title = trans('imet-core::form/v2/evaluation.BudgetAdequacy.title');
        $this->module_fields = [
            ['name' => 'EvaluationScore',  'type' => 'blade-imet-core::components.rating-0to5',   'label' => trans('imet-core::form/v2/evaluation.BudgetAdequacy.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('imet-core::form/v2/evaluation.BudgetAdequacy.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::form/v2/evaluation.BudgetAdequacy.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::form/v2/evaluation.BudgetAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::form/v2/evaluation.BudgetAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::form/v2/evaluation.BudgetAdequacy.ratingLegend');

        parent::__construct($attributes);

    }

//    public static function convert_v1_to_v2($record)
//    {
//        $record['EvaluationScore'] = null;
//        return $record;
//    }
}
