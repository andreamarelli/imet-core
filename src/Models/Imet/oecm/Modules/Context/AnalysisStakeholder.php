<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;

class AnalysisStakeholder extends Modules\Component\ImetModule
{
    protected $table = 'imet_oecm.context_analysis_stakeholders';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 5.1';
        $this->module_title = trans('imet-core::oecm_context.AnalysisStakeholder.title');
        $this->module_fields = [
            ['name' => 'Element', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnalysisStakeholder.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'Dependence', 'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.AnalysisStakeholder.fields.Dependence')],
            ['name' => 'Access', 'type' => 'suggestion-ImetOECM_Access', 'label' => trans('imet-core::oecm_context.AnalysisStakeholder.fields.Access')],
            ['name' => 'Rivalry', 'type' => 'toggle-yes_no', 'label' => trans('imet-core::oecm_context.AnalysisStakeholder.fields.Rivalry')],
            ['name' => 'Involvement', 'type' => 'toggle-yes_no', 'label' => trans('imet-core::oecm_context.AnalysisStakeholder.fields.Involvement')],
            ['name' => 'Accountability', 'type' => 'toggle-yes_no', 'label' => trans('imet-core::oecm_context.AnalysisStakeholder.fields.Accountability')],
            ['name' => 'Orientation', 'type' => 'toggle-yes_no', 'label' => trans('imet-core::oecm_context.AnalysisStakeholder.fields.Accountability')],
            ['name' => 'Comments', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnalysisStakeholder.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_context.AnalysisStakeholder.groups.group0'),
            'group1' => trans('imet-core::oecm_context.AnalysisStakeholder.groups.group1'),
            'group2' => trans('imet-core::oecm_context.AnalysisStakeholder.groups.group2'),
            'group3' => trans('imet-core::oecm_context.AnalysisStakeholder.groups.group3'),
            'group4' => trans('imet-core::oecm_context.AnalysisStakeholder.groups.group3'),
        ];

//        $this->predefined_values = [
//            'field' => 'Element',
//            'values' => [
//                'group0' => trans('imet-core::oecm_context.AnalysisStakeholder.predefined_values.group0'),
//                'group1' => trans('imet-core::oecm_context.AnalysisStakeholder.predefined_values.group1'),
//                'group2' => trans('imet-core::oecm_context.AnalysisStakeholder.predefined_values.group2'),
//                'group3' => trans('imet-core::oecm_context.AnalysisStakeholder.predefined_values.group3'),
//                'group4' => trans('imet-core::oecm_context.AnalysisStakeholder.predefined_values.group3')
//            ]
//        ];

        $this->module_info = trans('imet-core::oecm_context.StakeholdersNaturalResources.module_info');
        $this->ratingLegend = trans('imet-core::oecm_context.StakeholdersNaturalResources.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Preload data from CTX
     * @param $form_id
     * @param null $collection
     * @return array
     */
    public static function getModuleRecords($form_id, $collection = null): array
    {

        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $records = $module_records['records'];
        array_shift($records);
        $animals = Modules\Context\AnimalSpecies::getModule($form_id)->pluck('species')->toArray() ?? [];
        $vegetals = Modules\Context\VegetalSpecies::getModule($form_id)->pluck('species')->toArray() ?? [];
        $habitats = Modules\Context\Habitats::getModule($form_id)->pluck('EcosystemType')->toArray() ?? [];

        $species = [];
        if(count($animals)>0) {
            $species = explode("|", $animals[0]);
        }
        if(count($vegetals)>0) {
            $species = array_merge(explode("|", $vegetals[0]), $species);
        }
        if(count($habitats)>0) {
            $species = array_merge(explode("|", $habitats[0]), $species);
        }

        $preLoaded = [
            'field' => 'Element',
            'values' => [
                'group0' => $species
            ]
        ];
        $module_records['records'] = static::arrange_records($preLoaded, $records, $empty_record);
        return $module_records;
    }
}
