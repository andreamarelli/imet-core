<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KeyElements extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_key_elements';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Aspect';
    protected static $DEPENDENCIES = [
        [Objectives::class, 'Aspect'],
        [Modules\Evaluation\InformationAvailability::class, 'Aspect'],
        [Modules\Evaluation\ManagementActivities::class, 'Aspect']
    ];

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C4';
        $this->module_title = trans('imet-core::oecm_evaluation.KeyElements.title');
        $this->module_fields = [
            ['name' => 'Aspect',                'type' => 'blade-imet-core::oecm.evaluation.fields.key_elements_element',      'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Aspect')],
            ['name' => 'Importance',            'type' => 'disabled',      'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Importance')],
            ['name' => 'EvaluationScore',       'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.EvaluationScore')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Comments')],
        ];


        $this->module_groups = trans('imet-core::oecm_evaluation.KeyElements.groups');

        $this->module_subTitle = trans('imet-core::oecm_evaluation.KeyElements.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.KeyElements.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.KeyElements.module_info_EvaluationQuestion');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.KeyElements.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Preload data from CTX 5.1
     *
     * @param $predefined_values
     * @param $records
     * @param $empty_record
     * @return array
     */
    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        // Retrieve key elements (and importance calculation) form CTX
        $key_elements_direct =  collect(static::getKeyElementsFromSA($form_id, Stakeholders::ONLY_DIRECT))->keyBy('element');
        $key_elements_indirect =  collect(static::getKeyElementsFromSA($form_id, Stakeholders::ONLY_INDIRECT))->keyBy('element');
        $biodiversity_key_elements =  static::getBiodiversityKeyElementsFromCTX($form_id);

        // Set predefines values (key elements)
        $predefined = [
            'field' => 'Aspect',
            'values' => [
                'group0' => $key_elements_direct->pluck('element')->toArray(),
                'group1' => $key_elements_indirect->pluck('element')->toArray(),
                'group2' => $biodiversity_key_elements,
            ]
        ];

        $records = parent::arrange_records($predefined, $records, $empty_record);

        // Inject also importance
        foreach ($records as $index => $record){
            if($record['group_key']==='group0' && array_key_exists($record['Aspect'], $key_elements_direct->toArray())){
                $records[$index]['Importance'] = $key_elements_direct[$record['Aspect']]['importance'];
                $records[$index]['__num_stakeholders'] = $key_elements_direct[$record['Aspect']]['stakeholder_count'];
                $records[$index]['__group_stakeholders'] = $key_elements_direct[$record['Aspect']]['group'];;
            } else if($record['group_key']==='group1' && array_key_exists($record['Aspect'], $key_elements_indirect->toArray())){
                $records[$index]['Importance'] = $key_elements_indirect[$record['Aspect']]['importance'];
                $records[$index]['__num_stakeholders'] = $key_elements_indirect[$record['Aspect']]['stakeholder_count'];
                $records[$index]['__group_stakeholders'] = $key_elements_indirect[$record['Aspect']]['group'];;
            } else if($record['group_key']==='group2'){
                $records[$index]['Importance'] = null;
                $records[$index]['__num_stakeholders'] = null;
                $records[$index]['__group_stakeholders'] = null;
            }
        }

        return $records;
    }

    public static function getKeyElementsFromSA($form_id, $stakeholders_type): array
    {
        if($stakeholders_type == Stakeholders::ONLY_DIRECT){
            $users_key_elements = Modules\Context\AnalysisStakeholderDirectUsers::calculateKeyElementsImportances($form_id);
        } else {
            $users_key_elements = Modules\Context\AnalysisStakeholderIndirectUsers::calculateKeyElementsImportances($form_id);
        }
        $users_weights = collect(Stakeholders::calculateWeights($form_id, $stakeholders_type))
            ->sum();

        return collect($users_key_elements)
            ->map(function($item) use ($users_weights){
               $item['importance'] = $item['importance'] * $users_weights;
               return $item;
            })
            ->groupBy('element')
            ->map(function($group_element) use ($users_weights){

                $importance = $group_element
                        ->map(function($item){
                            return $item['importance'];
                        })
                        ->sum() / $users_weights;
                $importance = round($importance, 1);

                $stakeholder_count = $group_element
                    ->map(function($item){
                        return $item['stakeholder_count'];
                    })
                    ->sum();

                return [
                    'element' => $group_element[0]['element'],
                    'importance' => $importance,
                    'stakeholder_count' => $stakeholder_count,
                    'group' => $group_element[0]['group']
                ];
            })
            ->sortByDesc('importance')
            ->filter(function ($item){
                return $item['importance']!==null;
            })
            ->toArray();
    }

    public static function getBiodiversityKeyElementsFromCTX($form_id): array
    {
        $animals =
            Modules\Context\AnimalSpecies::getModule($form_id)
                ->filter(function ($item) {
                    return !empty($item['species']);
                })
                ->pluck('species')
                ->map(function ($item) {
                    return Str::contains($item, '|')
                        ? Animal::getScientificName($item)
                        : $item;
                })
                ->toArray();

        $plants =
            Modules\Context\VegetalSpecies::getModule($form_id)
                ->filter(function ($item) {
                    return !empty($item['species']);
                })
                ->pluck('species')
                ->toArray();

        $habitats =
            Modules\Context\Habitats::getModule($form_id)
                ->filter(function ($item) {
                    return !empty($item['EcosystemType']);
                })
                ->pluck('EcosystemType')
                ->map(function ($item) {
                    $labels = SelectionList::getList('ImetOECM_Habitats');
                    return array_key_exists($item, $labels) ?
                        $labels[$item]
                        : null;
                })
                ->toArray();

        return array_merge($animals, $plants, $habitats);
    }

    /**
     * Provide the list of prioritized key elements
     * @param $form_id
     * @return array
     */
    public static function getPrioritizedElements($form_id): array {
        return collect(static::getModuleRecords($form_id)['records'])
            ->filter(function($item){
                return $item['IncludeInStatistics'];
            })
            ->pluck('Aspect')
            ->toArray();
    }

}
