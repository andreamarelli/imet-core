<?php

namespace ImetCore\Models\Imet\v2\Modules\Context;

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

class Contexts extends Modules\Component\ImetModule
{
    protected $table = 'context_contexts';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 1.6';
        $this->module_title = trans('imet-core::v2_context.Contexts.title');
        $this->module_fields = [
            ['name' => 'Context',  'type' => 'disabled',   'label' => trans('imet-core::v2_context.Contexts.fields.Context')],
            ['name' => 'file',  'type' => 'upload',   'label' => trans('imet-core::v2_context.Contexts.fields.file')],
            ['name' => 'Summary',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Contexts.fields.Summary')],
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Contexts.fields.Source')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Contexts.fields.Observations')],
        ];

        $this->predefined_values = [
            'field' => 'Context',
            'values' => trans('imet-core::v2_context.Contexts.predefined_values')
        ];

        parent::__construct($attributes);
    }

}
