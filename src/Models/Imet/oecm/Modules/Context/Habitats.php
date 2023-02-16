<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Illuminate\Http\Request;

class Habitats extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_habitats';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.3';
        $this->module_title = trans('imet-core::oecm_context.Habitats.title');
        $this->module_fields = [
            ['name' => 'EcosystemType',             'type' => 'suggestion-ImetOECM_Habitats',   'label' => trans('imet-core::oecm_context.Habitats.fields.EcosystemType')],
            ['name' => 'ExploitedSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Habitats.fields.ExploitedSpecies')],
            ['name' => 'ProtectedSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Habitats.fields.ProtectedSpecies')],
            ['name' => 'DisappearingSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Habitats.fields.DisappearingSpecies')],
            ['name' => 'PopulationEstimation', 'type' => 'dropdown-ImetOECM_PopulationStatus', 'label' => trans('imet-core::oecm_context.Habitats.fields.PopulationEstimation')],
            ['name' => 'DescribeEstimation', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.Habitats.fields.DescribeEstimation')],
            ['name' => 'Comments', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.Habitats.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::oecm_context.Habitats.module_info');

        parent::__construct($attributes);

    }

//    public static function getVueData($form_id, $collection = null): array
//    {
//        $vue_data = parent::getVueData($form_id, $collection);
//        $vue_data['warning_on_save'] =  trans('imet-core::oecm_context.Habitats.warning_on_save');
//        return $vue_data;
//    }
//
//    public static function updateModule(Request $request): array
//    {
//        static::forceLanguage($request->input('form_id'));
//
//        $records = Payload::decode($request->input('records_json'));
//        $form_id = $request->input('form_id');
//
//        static::dropFromDependencies($form_id, $records, [
//            Modules\Evaluation\ImportanceHabitats::class,
//            Modules\Evaluation\InformationAvailability::class,
//            Modules\Evaluation\KeyConservationTrend::class,
//            Modules\Evaluation\ManagementActivities::class,
//        ]);
//
//        return parent::updateModule($request);
//    }



}
