<?php

namespace AndreaMarelli\ImetCore\Models\Imet\OECM\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\OECM\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class Designation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.designation';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1.1';
        $this->module_title = trans('imet-core::oecm_evaluation.Designation.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.EvaluationScore')],
            ['name' => 'SignificativeClassification',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.SignificativeClassification')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.Comments')],
        ];

        $this->module_subTitle = trans('imet-core::oecm_evaluation.Designation.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.Designation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.Designation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.Designation.ratingLegend');

        parent::__construct($attributes);

    }
}
