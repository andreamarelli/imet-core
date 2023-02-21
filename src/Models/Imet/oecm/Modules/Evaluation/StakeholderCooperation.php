<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class StakeholderCooperation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_stakeholder_cooperation';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR8';
        $this->module_title = trans('imet-core::oecm_evaluation.StakeholderCooperation.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'text-area',          'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Element'), 'other'=>'rows="3"'],
            ['name' => 'MPInvolvement',     'type' => 'checkbox-boolean_numeric',  'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.MPInvolvement')],
            ['name' => 'MPIImplementation', 'type' => 'checkbox-boolean_numeric',  'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.MPIImplementation')],
            ['name' => 'BAInvolvement',     'type' => 'checkbox-boolean_numeric',  'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.BAInvolvement')],
            ['name' => 'EEInvolvement',     'type' => 'checkbox-boolean_numeric',  'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.EEInvolvement')],
            ['name' => 'Cooperation',       'type' => 'imet-core::rating-0to3WithNA',  'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Cooperation')],
            ['name' => 'Comments',          'type' => 'text-area',               'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_evaluation.StakeholderCooperation.groups.group0'),
            'group1' => trans('imet-core::oecm_evaluation.StakeholderCooperation.groups.group1'),
            'group2' => trans('imet-core::oecm_evaluation.StakeholderCooperation.groups.group2'),
            'group3' => trans('imet-core::oecm_evaluation.StakeholderCooperation.groups.group3')
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('imet-core::oecm_evaluation.StakeholderCooperation.predefined_values.group0'),
                'group1' => trans('imet-core::oecm_evaluation.StakeholderCooperation.predefined_values.group1'),
                'group2' => trans('imet-core::oecm_evaluation.StakeholderCooperation.predefined_values.group2'),
                'group3' => trans('imet-core::oecm_evaluation.StakeholderCooperation.predefined_values.group3'),
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.StakeholderCooperation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.StakeholderCooperation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.StakeholderCooperation.ratingLegend');

        parent::__construct($attributes);

    }
}
