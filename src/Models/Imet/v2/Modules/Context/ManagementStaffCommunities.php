<?php

namespace ImetCore\Models\Imet\v2\Modules\Context;

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

class ManagementStaffCommunities extends Modules\Component\ImetModule
{
    protected $table = 'context_management_staff_communities';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.3';
        $this->module_title = trans('imet-core::v2_context.ManagementStaffCommunities.title');
        $this->module_fields = [
            ['name' => 'Community',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaffCommunities.fields.Community')],
            ['name' => 'Role1',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaffCommunities.fields.Role1')],
            ['name' => 'StaffNUmberRole1',  'type' => 'integer',   'label' => trans('imet-core::v2_context.ManagementStaffCommunities.fields.StaffNUmberRole1')],
        ];

        parent::__construct($attributes);
    }

}
