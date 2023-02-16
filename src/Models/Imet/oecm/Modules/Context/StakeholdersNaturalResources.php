<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class StakeholdersNaturalResources extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_stakeholders_natural_resources';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 3.1.2';
        $this->module_title = trans('imet-core::oecm_context.StakeholdersNaturalResources.title');
        $this->module_fields = [
            ['name' => 'Element',                'type' => 'text-area', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'GeographicalProximity',  'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.GeographicalProximity')],
            ['name' => 'Engagement',             'type' => 'suggestion-ImetOECM_Engagement', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Engagement')],
            ['name' => 'Impact',                 'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Impact')],
            ['name' => 'Role',                   'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Role')],
            ['name' => 'Comments',               'type' => 'text-area', 'label' => trans('imet-core::oecm_context.StakeholdersNaturalResources.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_context.StakeholdersNaturalResources.groups');
        $this->ratingLegend = trans('imet-core::oecm_context.StakeholdersNaturalResources.ratingLegend');

        parent::__construct($attributes);
    }
}
