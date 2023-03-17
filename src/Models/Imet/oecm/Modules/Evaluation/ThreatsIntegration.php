<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use Exception;
use Illuminate\Http\Request;

/**
 * @property $titles
 */
class ThreatsIntegration extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_threats_integration';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C3.2';
        $this->module_title = trans('imet-core::oecm_evaluation.ThreatsIntegration.title');
        $this->module_fields = [
            ['name' => 'Threat',           'type' => 'blade-imet-core::oecm.evaluation.fields.threat_with_ranking',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.Threat')],
            ['name' => 'Integration',       'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.Integration')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Threat',
            'values' => trans('imet-core::oecm_lists.MainThreat')
        ];

        $this->ratingLegend = trans('imet-core::oecm_evaluation.ThreatsIntegration.ratingLegend');

        parent::__construct($attributes);
    }

    public static function getModuleRecords($form_id, $collection = null): array
    {
        $module_records = parent::getModuleRecords($form_id, $collection);

        $threats_ranking = collect(Threats::calculateRanking($form_id))
            ->pluck('__score', 'Value')
            ->toArray();

        foreach ($module_records['records'] as $index => $record){
            $module_records['records'][$index]['__score'] = $threats_ranking[$record['Threat']];
        }

        return $module_records;
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
        static::dropFromDependentModules($form_id, $records, 'Threat', [
            [Modules\Evaluation\InformationAvailability::class, 'Element'],
            [Modules\Evaluation\ManagementActivities::class, 'Activity']
        ]);

        // Execute update
        $request->merge(['records_json' => Payload::encode($records)]);
        return parent::updateModule($request);
    }


}
