<?php

namespace ImetCore\Models\Imet\v1\Modules\Context;

use ImetCore\Models\User\Role;

class Objectives4 extends _Objectives
{
    protected $table = 'context_objectives4';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 4.6';
        $this->module_info = trans('imet-core::v1_context.Objectives4.module_info');

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
            'table' => 'Objectives4',
            'fields' => [
                'Status', 'Benchmark1', 'Benchmark2', 'Benchmark3', 'Objective'
            ]
        ];
    }
}
