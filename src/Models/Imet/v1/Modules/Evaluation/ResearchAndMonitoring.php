<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;

class ResearchAndMonitoring extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_research_and_monitoring';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR17';
        $this->module_title = trans('imet-core::form/v1/evaluation.ResearchAndMonitoring.title');
        $this->module_fields = [
            ['name' => 'Program',  'type' => 'text-area',   'label' => trans('imet-core::form/v1/evaluation.ResearchAndMonitoring.fields.Program')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::form/v1/evaluation.ResearchAndMonitoring.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::form/v1/evaluation.ResearchAndMonitoring.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Program',
            'values' => trans('imet-core::form/v1/evaluation.ResearchAndMonitoring.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::form/v1/evaluation.ResearchAndMonitoring.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::form/v1/evaluation.ResearchAndMonitoring.module_info_Rating');
        $this->ratingLegend = trans('imet-core::form/v1/evaluation.ResearchAndMonitoring.ratingLegend');

        parent::__construct($attributes);

    }
}
