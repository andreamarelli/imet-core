<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class ImportanceClassification extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_importance_c12';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1.2';
        $this->module_title = trans('imet-core::form/v1/evaluation.ImportanceClassification.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::form/v1/evaluation.ImportanceClassification.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::form/v1/evaluation.ImportanceClassification.fields.EvaluationScore')],
            ['name' => 'SignificativeClassification',  'type' => 'toggle-yes_no',   'label' => trans('imet-core::form/v1/evaluation.ImportanceClassification.fields.SignificativeClassification')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::form/v1/evaluation.ImportanceClassification.fields.Comments')],
        ];

        $this->module_subTitle = trans('imet-core::form/v1/evaluation.ImportanceClassification.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::form/v1/evaluation.ImportanceClassification.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::form/v1/evaluation.ImportanceClassification.module_info_Rating');
        $this->ratingLegend = trans('imet-core::form/v1/evaluation.ImportanceClassification.ratingLegend');

        parent::__construct($attributes);

    }
}
