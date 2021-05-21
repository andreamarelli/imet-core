<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class _Objectives extends Modules\Component\ImetModule
{

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_title = trans('form/imet/v2/context.Objectives.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Objectives.fields.Element')],
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Objectives.fields.Status')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Objectives.fields.Objective')],
        ];

        $this->module_common_fields = [
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('form/imet/v2/context.Objectives.fields.Comments')],
        ];

        parent::__construct($attributes);
    }

//    public static function convert_v1_to_v2($record)
//    {
//        $record = static::addField($record, 'Element');
//        $record = static::dropField($record, 'Benchmark1');
//        $record = static::dropField($record, 'Benchmark2');
//        $record = static::dropField($record, 'Benchmark3');
//        return $record;
//    }

}
