<?php

namespace ImetCore\Models\Imet\v1\Modules\Context;

use ImetCore\Models\User\Role;

class Objectives5 extends _Objectives
{
    protected $table = 'context_objectives5';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 5.2';
        $this->module_info = trans('imet-core::v1_context.Objectives5.module_info');

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
            'table' => 'Objectives5',
            'fields' => [
                'Status', 'Benchmark1', 'Benchmark2', 'Benchmark3', 'Objective'
            ]
        ];
    }
}
