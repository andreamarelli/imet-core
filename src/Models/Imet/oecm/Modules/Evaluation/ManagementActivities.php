<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class ManagementActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_management_activities';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR6';
        $this->module_title = trans('imet-core::oecm_evaluation.ManagementActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'blade-imet-core::v2.evaluation.fields.show_species',   'label' => trans('imet-core::oecm_evaluation.ManagementActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'imet-core::rating-0to3WithNA',   'label' => trans('imet-core::oecm_evaluation.ManagementActivities.fields.EvaluationScore')],
            ['name' => 'InManagementPlan',  'type' => 'checkbox-boolean_numeric',   'label' => trans('imet-core::oecm_evaluation.ManagementActivities.fields.InManagementPlan')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.ManagementActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_evaluation.ManagementActivities.groups.group0')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.ManagementActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.ManagementActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.ManagementActivities.ratingLegend');

        parent::__construct($attributes);

    }



}
