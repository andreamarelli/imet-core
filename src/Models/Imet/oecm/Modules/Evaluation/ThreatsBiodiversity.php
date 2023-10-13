<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Services\ThreatsService;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use Illuminate\Support\Str;

class ThreatsBiodiversity extends Modules\Component\ImetModule_Eval {

    protected $table = 'imet_oecm.eval_threats_biodiversity';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C3.1.1';
        $this->module_title = trans('imet-core::oecm_evaluation.ThreatsBiodiversity.title');
        $this->module_fields = [
            ['name' => 'Criteria',      'type' => 'disabled',                       'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Criteria')],
            ['name' => 'Impact',        'type' => 'imet-core::rating-0to3',         'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Impact')],
            ['name' => 'Extension',     'type' => 'imet-core::rating-0to3',         'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Extension')],
            ['name' => 'Duration',      'type' => 'imet-core::rating-0to3',         'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Duration')],
            ['name' => 'Trend',         'type' => 'imet-core::rating-Minus2to2',    'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Trend')],
            ['name' => 'Probability',   'type' => 'imet-core::rating-0to3',         'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Probability')],
            ['name' => 'Note',          'type' => 'text-area',                      'label' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.fields.Note')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.groups.group0'),
            'group1' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.groups.group1'),
            'group2' => trans('imet-core::oecm_evaluation.ThreatsBiodiversity.groups.group2'),
        ];

        $this->module_info = trans('imet-core::oecm_evaluation.ThreatsBiodiversity.module_info');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.ThreatsBiodiversity.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Inject additional predefined values (last 3 groups) retrieved from CTX
     */
    protected static function getPredefined($form_id = null): array
    {
        return [
            'field' => 'Criteria',
            'values' => [

                // Animals
                'group0' => Modules\Context\AnimalSpecies::getModule($form_id)
                    ->filter(function ($item) {
                        return !empty($item['species']);
                    })
                    ->pluck('species')
                    ->map(function ($item) {
                        return Str::contains($item, '|')
                            ? Animal::getScientificName($item)
                            : $item;
                    })
                    ->toArray(),

                // Plants
                'group1' => Modules\Context\VegetalSpecies::getModule($form_id)
                    ->filter(function ($item) {
                        return !empty($item['species']);
                    })
                    ->pluck('species')
                    ->toArray(),

                // Habitats
                'group2' => Modules\Context\Habitats::getModule($form_id)
                    ->filter(function ($item) {
                        return !empty($item['EcosystemType']);
                    })
                    ->map(function ($item) {
                        $labels = SelectionList::getList('ImetOECM_Habitats');
                        $item['EcosystemType'] = array_key_exists($item['EcosystemType'], $labels) ?
                            $labels[$item['EcosystemType']]
                            : null;
                        return empty($item['EcosystemDescription'])
                            ? $item['EcosystemType']
                            : $item['EcosystemType'] . ' - ' . $item['EcosystemDescription'];
                    })
                    ->toArray(),

            ],
        ];
    }


    /**
     * Calculate threat's ranking
     *
     * @param $form_id
     * @param $records
     * @return array
     */
    public static function calculateRanking($form_id, $records = null): array
    {
        $records = $records ?? static::getModuleRecords($form_id)['records'];

        return ThreatsService::calculateRanking($records);
    }


}