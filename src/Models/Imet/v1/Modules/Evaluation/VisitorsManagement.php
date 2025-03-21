<?php

namespace ImetCore\Models\Imet\v1\Modules\Evaluation;

use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\User\Role;

class VisitorsManagement extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_visitors_management';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR14';
        $this->module_title = trans('imet-core::v1_evaluation.VisitorsManagement.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.VisitorsManagement.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.VisitorsManagement.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.VisitorsManagement.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.VisitorsManagement.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.VisitorsManagement.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => [
                'group0' => trans('imet-core::v1_evaluation.VisitorsManagement.predefined_values.group0'),
                'group1' => trans('imet-core::v1_evaluation.VisitorsManagement.predefined_values.group1')
            ]
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.VisitorsManagement.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.VisitorsManagement.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.VisitorsManagement.ratingLegend');

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
            'table' => 'Eval_VisitorsManagement',
            'fields' => [
                'Aspect', 'EvaluationScore', 'Comments', 'GroupAspect'
            ]
        ];
    }

    /**
     * Review data from SQLITE
     *
     * @param $record
     * @param $sqlite_connection
     * @return array
     */
    protected static function conversionDataReview($record, $sqlite_connection): array
    {
        return static::convertGroupLabelToKey($record, 'GroupAspect');
    }
}
