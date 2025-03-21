<?php

namespace ImetCore\Models\Imet\v1\Modules\Evaluation;

use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\User\Role;

class ActorsRelations extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_actors_relations';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR13';
        $this->module_title = trans('imet-core::v1_evaluation.ActorsRelations.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ActorsRelations.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.ActorsRelations.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.ActorsRelations.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ActorsRelations.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => trans('imet-core::v1_evaluation.ActorsRelations.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ActorsRelations.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ActorsRelations.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ActorsRelations.ratingLegend');

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
            'table' => 'Eval_ActorsRelations',
            'fields' => [
                'Activity', 'EvaluationScore', 'Percentage', 'Comments'
            ]
        ];
    }
}
