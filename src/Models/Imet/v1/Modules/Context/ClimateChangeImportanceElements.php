<?php

namespace ImetCore\Models\Imet\v1\Modules\Context;

use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\User\Role;

class ClimateChangeImportanceElements extends Modules\Component\ImetModule
{
    protected $table = 'context_climate_change_importance_elements';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 6.1';
        $this->module_title = trans('imet-core::v1_context.ClimateChangeImportanceElements.title');
        $this->module_fields = [
            ['name' => 'GroupElement',  'type' => 'text-area',        'label' => trans('imet-core::v1_context.ClimateChangeImportanceElements.fields.GroupElement')],
            ['name' => 'Element',       'type' => 'text-area',   'label' => trans('imet-core::v1_context.ClimateChangeImportanceElements.fields.Element')],
            ['name' => 'Application',   'type' => 'rating-0to3', 'label' => trans('imet-core::v1_context.ClimateChangeImportanceElements.fields.Application')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ClimateChangeImportanceElements.fields.Observations')],
        ];

        $this->predefined_values = [
            'field' => 'GroupElement',
            'values' => trans('imet-core::v1_context.ClimateChangeImportanceElements.predefined_values')
        ];

        $this->module_info = trans('imet-core::v1_context.ClimateChangeImportanceElements.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.ClimateChangeImportanceElements.ratingLegend');

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
            'table' => 'ClimateChangeImportanceElements',
            'fields' => [
                'GroupElement', 'Element', 'Application', 'Observations'
            ]
        ];
    }
}
