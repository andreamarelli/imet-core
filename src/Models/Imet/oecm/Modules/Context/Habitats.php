<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Component\ImetModule;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Exception;
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
            ['name' => 'EcosystemType',             'type' => 'dropdown-ImetOECM_Habitats',   'label' => trans('imet-core::oecm_context.Habitats.fields.EcosystemType')],
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
        static::dropFromDependentModules($form_id, $records, 'EcosystemType', [
            [Modules\Context\AnalysisStakeholderAccessGovernance::class, 'Element']
        ]);

        // Execute update
        $request->merge(['records_json' => Payload::encode($records)]);
        return parent::updateModule($request);
    }

    /**
     * Override: replace values with labels
     *
     * @param $form_id
     * @param $updated_records
     * @param $reference_field
     * @param $dependency_classes
     * @return void
     * @throws Exception
     */
    public static function dropFromDependentModules($form_id, $updated_records, $reference_field, $dependency_classes)
    {
        // Get list of values (of reference field) from DB and from updated records
        $existing_values = static::getModule($form_id)->pluck($reference_field)->unique()->toArray();
        $updated_values = collect($updated_records)->pluck($reference_field)->unique()->toArray();

        // Make diff to find out what to drop
        $to_be_dropped = array_diff($existing_values, $updated_values);
        $to_be_dropped = array_values($to_be_dropped);

        // ### replace values with labels ###
        $labels =  SelectionList::getList('ImetOECM_Habitats');
        foreach ($to_be_dropped as $index => $item){
            $to_be_dropped[$index] = $labels[$item];
        }

        foreach ($dependency_classes as [$dependency_class, $dependency_field]){
            /** @var ImetModule $dependency_class */
            $dependency_class::dropOrphansDependencyRecords($form_id, $dependency_field, $to_be_dropped);
        }
    }

}
