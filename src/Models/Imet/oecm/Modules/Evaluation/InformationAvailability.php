<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

class InformationAvailability extends Modules\Component\ImetModule_Eval
{
    protected $table = 'imet_oecm.eval_information_availability';
    protected $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Element';

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'I1';
        $this->module_title = trans('imet-core::oecm_evaluation.InformationAvailability.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.InformationAvailability.fields.Element')],
            ['name' => 'EvaluationScore',   'type' => 'imet-core::rating-0to3',   'label' => trans('imet-core::oecm_evaluation.InformationAvailability.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.InformationAvailability.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.InformationAvailability.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.InformationAvailability.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.InformationAvailability.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Override
     * @param $record
     * @param null $foreign_key
     * @return bool
     */
    public function isEmptyRecord($record, $foreign_key=null): bool
    {
        if($record['EvaluationScore']!==null || $record['Comments']!==null){
            return false;
        }
        return true;
    }


    /**
     * Preload data from C4
     *
     * @param $predefined_values
     * @param $records
     * @param $empty_record
     * @return array
     */
    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        $key_elements = array_merge(
            KeyElements::getPrioritizedElements($form_id),
            Designation::getPrioritizedElements($form_id),
            SupportsAndConstraintsIntegration::getPrioritizedElements($form_id),
            ThreatsIntegration::getPrioritizedElements($form_id)
        );

        $preLoaded = [
            'field' => 'Element',
            'values' => $key_elements
        ];

        return parent::arrange_records($preLoaded, $records, $empty_record);
    }

}
