<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;


class ObjectivesIntrants extends _Objectives
{
    protected $table = 'imet.eval_objectives_intrants';

    public function __construct(array $attributes = [])
    {
        $this->module_code = 'IX';
        $this->module_info = trans('imet-core::form/v2/evaluation.ObjectivesIntrants.module_info');

        parent::__construct($attributes);
    }
}
