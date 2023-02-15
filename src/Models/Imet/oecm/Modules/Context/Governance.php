<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class Governance extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_governance';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 1.2';
        $this->module_title = trans('imet-core::oecm_context.Governance.title');
        $this->module_fields = [
            ['name' => 'Name',               'type' => 'text-area',         'label' => trans('imet-core::oecm_context.Governance.fields.Stakeholder'),            'other' => 'style="width:200px"'],
            ['name' => 'Type',       'type' => 'dropdown-OECM_InstitutionType',      'label' => trans('imet-core::oecm_context.Governance.fields.InstitutionType'),    'other' => 'style="width:205px"'],
            ['name' => 'DateOfCreation',     'type' => 'dropdown-ImetV2_PartnershipsType',     'label' => trans('imet-core::oecm_context.Governance.fields.CreationYear'),  'other' => 'style="width:205px"'],
            ['name' => 'OfficialRecognition',     'type' => 'checkbox-boolean',     'label' => trans('imet-core::oecm_context.Governance.fields.OfficialRecognition'),  'other' => 'style="width:205px"'],
            ['name' => 'SupervisoryInstitution',   'type' => 'text-area',     'label' => trans('imet-core::oecm_context.Governance.fields.SupervisoryInstitution'),  'other' => 'style="width:205px"'],
        ];

        $this->module_common_fields = [
            ['name' => 'Type',      'type' => 'suggestion_multiple-ImetOECM_GovernanceType',   'label' => trans('imet-core::oecm_context.Governance.fields.Type')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Governance.fields.Comments')],
        ];

        parent::__construct($attributes);
    }
}
