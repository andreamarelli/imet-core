<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class DesignAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet.eval_design_adequacy';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'P2';
        $this->module_title = trans('imet-core::v2_evaluation.DesignAdequacy.title');
        $this->module_fields = [
            ['name' => 'Values',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.DesignAdequacy.fields.Values')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.DesignAdequacy.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.DesignAdequacy.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Values',
            'values' => trans('imet-core::v2_evaluation.DesignAdequacy.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.DesignAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.DesignAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.DesignAdequacy.ratingLegend');

        parent::__construct($attributes);
    }


}
