<?php

namespace ImetCore\Models\Imet\v2\Modules\Context;

use ImetCore\Models\User\Role;

class Objectives2 extends _Objectives
{
    protected $table = 'context_objectives2';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_code = 'CTX 2.5';
        $this->module_info = trans('imet-core::v2_context.Objectives2.module_info');

        parent::__construct($attributes);

    }
}
