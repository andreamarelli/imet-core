<?php

namespace ImetCore\Models\Imet\v1\Modules\Context;

use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\User\Role;

class Equipments extends Modules\Component\ImetModule
{
    protected $table = 'context_equipments';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 3.3';
        $this->module_title = trans('imet-core::v1_context.Equipments.title');
        $this->module_fields = [
            ['name' => 'Resource',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Equipments.fields.Resource')],
            ['name' => 'AdequacyLevel',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_context.Equipments.fields.AdequacyLevel')],
        ];

        $this->predefined_values = [
            'field' => 'Resource',
            'values' => [
                'group0' => trans('imet-core::v1_context.Equipments.predefined_values.group0'),
                'group1' => trans('imet-core::v1_context.Equipments.predefined_values.group1'),
                'group2' => trans('imet-core::v1_context.Equipments.predefined_values.group2'),
                'group3' => trans('imet-core::v1_context.Equipments.predefined_values.group3'),
                'group4' => trans('imet-core::v1_context.Equipments.predefined_values.group4'),
                'group5' => trans('imet-core::v1_context.Equipments.predefined_values.group5'),
                'group6' => trans('imet-core::v1_context.Equipments.predefined_values.group6'),
                'group7' => trans('imet-core::v1_context.Equipments.predefined_values.group7'),
                'group8' => trans('imet-core::v1_context.Equipments.predefined_values.group8'),
                'group9' => trans('imet-core::v1_context.Equipments.predefined_values.group9'),
                'group10' =>trans('imet-core::v1_context.Equipments.predefined_values.group10'),
                'group11' =>trans('imet-core::v1_context.Equipments.predefined_values.group11'),
                'group12' =>trans('imet-core::v1_context.Equipments.predefined_values.group12')
            ]
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_context.Equipments.groups.group0'),
            'group1' => trans('imet-core::v1_context.Equipments.groups.group1'),
            'group2' => trans('imet-core::v1_context.Equipments.groups.group2'),
            'group3' => trans('imet-core::v1_context.Equipments.groups.group3'),
            'group4' => trans('imet-core::v1_context.Equipments.groups.group4'),
            'group5' => trans('imet-core::v1_context.Equipments.groups.group5'),
            'group6' => trans('imet-core::v1_context.Equipments.groups.group6'),
            'group7' => trans('imet-core::v1_context.Equipments.groups.group7'),
            'group8' => trans('imet-core::v1_context.Equipments.groups.group8'),
            'group9' => trans('imet-core::v1_context.Equipments.groups.group9'),
            'group10' => trans('imet-core::v1_context.Equipments.groups.group10'),
            'group11' => trans('imet-core::v1_context.Equipments.groups.group11'),
            'group12' => trans('imet-core::v1_context.Equipments.groups.group12'),
        ];

        $this->ratingLegend = trans('imet-core::v1_context.Equipments.ratingLegend');

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
            'table' => 'Equipments',
            'fields' => [
                'Resource', 'AdequacyLevel', 'GroupResources'
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
        return static::convertGroupLabelToKey($record, 'GroupResources');
    }
}
