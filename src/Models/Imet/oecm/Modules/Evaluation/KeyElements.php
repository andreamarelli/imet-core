<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class KeyElements extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_key_elements';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C2';
        $this->module_title = trans('imet-core::oecm_evaluation.KeyElements.title');
        $this->module_fields = [
            ['name' => 'Aspect',                'type' => 'disabled',      'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Aspect')],
            ['name' => 'EvaluationScore',       'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.EvaluationScore')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.KeyElements.fields.Comments')],
        ];

//        $this->module_groups = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.groups');     // Re-use groups from CTX 5.1
//        $this->titles = trans('imet-core::oecm_context.AnalysisStakeholderAccessGovernance.titles');            // Re-use titles from CTX 5.1

        $this->module_subTitle = trans('imet-core::oecm_evaluation.KeyElements.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.KeyElements.module_info_EvaluationQuestion');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.KeyElements.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Preload data from CTX 5.1
     *
     * @param $form_id
     * @param null $collection
     * @return array
     */
    public static function getModuleRecords($form_id, $collection = null): array
    {
        $module_records = parent::getModuleRecords($form_id, $collection);
        $empty_record = static::getEmptyRecord($form_id);

        $records = $module_records['records'];
        $preLoaded = [
            'field' => 'Aspect',
            'values' => self::ctx5and6($form_id)
        ];

        $module_records['records'] = static::arrange_records($preLoaded, $records, $empty_record);
        return $module_records;
    }

    public static function ctx5and6($form_id)
    {
        $ctx5 = Modules\Context\AnalysisStakeholderAccessGovernance::getModuleRecords($form_id);
        $ctx5_averages = Modules\Context\AnalysisStakeholderAccessGovernance::calculateStakeholdersAverages($ctx5['records'], $form_id);

        $ctx6 = Modules\Context\AnalysisStakeholderTrendsThreats::getModuleRecords($form_id);
        $ctx6_averages = Modules\Context\AnalysisStakeholderTrendsThreats::calculateStakeholdersAverages($ctx6['records'], $form_id);
        $ctx6_averages = collect($ctx6_averages)->pluck('Average', 'Element')->toArray();

        $averages = [];
        foreach ($ctx5_averages as $key=>$ctx5_average){
            $averages[$key] = null;
            if(array_key_exists($key, $ctx6_averages)){
                $averages[$key] = ($ctx5_average + (100-$ctx6_averages[$key])) / 2;
            }
        }

        return $averages;
    }
}
