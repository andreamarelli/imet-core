<?php

namespace ImetCore\Models\Imet\v1\Modules\Evaluation;

use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\User\Role;

class ObjectivesGovernance extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_objectives_c11';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1.1';
        $this->module_title = trans('imet-core::v1_evaluation.ObjectivesGovernance.title');
        $this->module_fields = [
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ObjectivesGovernance.fields.Status')],
            ['name' => 'Benchmark1',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ObjectivesGovernance.fields.Benchmark1')],
            ['name' => 'Benchmark2',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ObjectivesGovernance.fields.Benchmark2')],
            ['name' => 'Benchmark3',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ObjectivesGovernance.fields.Benchmark3')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ObjectivesGovernance.fields.Objective')],
        ];

        $this->module_info = trans('imet-core::v1_evaluation.ObjectivesGovernance.module_info');

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
            'table' => 'Eval_ObjectivesC11',
            'fields' => [
                'Status', 'Benchmark1', 'Benchmark2', 'Benchmark3', 'Objective'
            ]
        ];
    }
}
