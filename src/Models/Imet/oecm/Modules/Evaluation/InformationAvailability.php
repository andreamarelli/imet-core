<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class InformationAvailability extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_information_availability';
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'I1';
        $this->module_title = trans('imet-core::oecm_evaluation.InformationAvailability.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.InformationAvailability.fields.Element')],
            ['name' => 'EvaluationScore',   'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.InformationAvailability.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.InformationAvailability.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_evaluation.InformationAvailability.groups');

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.InformationAvailability.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.InformationAvailability.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.InformationAvailability.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Preload data from CTX
     * @param $form_id
     * @param null $collection
     * @return array
     */
//    public static function getModuleRecords($form_id, $collection = null): array
//    {
//
//        $module_records = parent::getModuleRecords($form_id, $collection);
//        $empty_record = static::getEmptyRecord($form_id);
//
//        $records = $module_records['records'];
//        $preLoaded = [
//            'field' => 'Element',
//            'values' => [
//                'group0' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item){
//                                return $item['IncludeInStatistics'] && $item['group_key']==="group0";
//                            })->pluck('Aspect')->toArray(),
//                'group1' =>Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item){
//                                return $item['IncludeInStatistics'] && $item['group_key']==="group1";
//                            })->pluck('Aspect')->toArray(),
//            ]
//        ];
//
//        $module_records['records'] =  static::arrange_records($preLoaded, $records, $empty_record);
//        return $module_records;
//    }


//    /**
//     * Override
//     * @param $record
//     * @param null $foreign_key
//     * @return bool
//     */
//    public function isEmptyRecord($record, $foreign_key=null): bool
//    {
//        $isEmpty = true;
//
//        if($record['EvaluationScore']!==null
//            || $record['Comments']!==null
//        ){
//            $isEmpty = false;
//        }
//
//        return $isEmpty;
//    }


}
