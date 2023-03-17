<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Exception;
use Illuminate\Http\Request;

class VegetalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_species_vegetal_presence';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {
        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.2';
        $this->module_title = trans('imet-core::oecm_context.VegetalSpecies.title');
        $this->module_fields = [
            ['name' => 'species', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.VegetalSpecies.fields.SpeciesID')],
            ['name' => 'ExploitedSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.VegetalSpecies.fields.ExploitedSpecies')],
            ['name' => 'ProtectedSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.VegetalSpecies.fields.ProtectedSpecies')],
            ['name' => 'DisappearingSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.VegetalSpecies.fields.DisappearingSpecies')],
            ['name' => 'InvasiveSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.VegetalSpecies.fields.InvasiveSpecies')],
            ['name' => 'PopulationEstimation', 'type' => 'dropdown-ImetOECM_PopulationStatus', 'label' => trans('imet-core::oecm_context.VegetalSpecies.fields.PopulationEstimation')],
            ['name' => 'DescribeEstimation', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.VegetalSpecies.fields.DescribeEstimation')],
            ['name' => 'Comments', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.VegetalSpecies.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::oecm_context.VegetalSpecies.module_info');

        parent::__construct($attributes);
    }

    /**
     * clean dependencies
     *
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public static function updateModule(Request $request): array
    {
        // get request
        $records = Payload::decode($request->input('records_json'));

        // Clean dependent modules form removed records
        $form_id = $request->input('form_id');
        static::dropFromDependentModules($form_id, $records, 'species', [
            [Modules\Context\AnalysisStakeholderAccessGovernance::class, 'Element']
        ]);

        // Execute update
        $request->merge(['records_json' => Payload::encode($records)]);
        return parent::updateModule($request);
    }

}
