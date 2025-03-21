<?php

namespace ImetCore\Models\Imet\v1\Modules\Evaluation;

use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\User\Role;

class AdministrativeManagement extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_administrative_management';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'PR5';
        $this->module_title = trans('imet-core::v1_evaluation.AdministrativeManagement.title');
        $this->module_fields = [
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.AdministrativeManagement.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.AdministrativeManagement.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.AdministrativeManagement.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.AdministrativeManagement.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.AdministrativeManagement.ratingLegend');

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
            'table' => 'Eval_AdministrativeManagement',
            'fields' => [
                'EvaluationScore', 'Comments'
            ]
        ];
    }
}
