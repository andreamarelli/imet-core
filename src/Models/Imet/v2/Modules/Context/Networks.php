<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ModularForms\Helpers\Type\JSON;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class Networks extends Modules\Component\ImetModule
{
    protected $table = 'imet.context_networks';

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 1.4';
        $this->module_title = trans('form/imet/v2/context.Networks.title');
        $this->module_fields = [
            ['name' => 'NetworkName',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Networks.fields.NetworkName')],
            ['name' => 'ProtectedAreas',  'type' => 'selector-wdpa_multiple',   'label' => trans('form/imet/v2/context.Networks.fields.ProtectedAreas')],
        ];

        $this->module_groups = [
            'group0' => trans('form/imet/v2/context.Networks.groups.group0'),
            'group1' => trans('form/imet/v2/context.Networks.groups.group1'),
            'group2' => trans('form/imet/v2/context.Networks.groups.group2'),
        ];

        parent::__construct($attributes);

    }

    public static function upgradeModule($record, $v1_to_v2 = false, $imet_version = null)
    {
        // ####  v1 -> v2  ####
        if($v1_to_v2 && JSON::isJson($record['ProtectedAreas'])){
            $record['ProtectedAreas'] = implode(',', json_decode($record['ProtectedAreas']));
        }

        return $record;
    }
}
