<?php

namespace ImetCore\Models\Imet\v2\Modules\Evaluation;

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

class RegulationsAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_regulations_adequacy';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'P1';
        $this->module_title = trans('imet-core::v2_evaluation.RegulationsAdequacy.title');
        $this->module_fields = [
            ['name' => 'Regulation',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.RegulationsAdequacy.fields.Regulation')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.RegulationsAdequacy.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.RegulationsAdequacy.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Regulation',
            'values' => trans('imet-core::v2_evaluation.RegulationsAdequacy.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.RegulationsAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.RegulationsAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.RegulationsAdequacy.ratingLegend');

        parent::__construct($attributes);
    }

    public static function get_marine_predefined(): array
    {
        $predefined = (new static())->predefined_values['values'];
        return [
            $predefined[9],
            $predefined[10],
            $predefined[11],
            $predefined[12],
            $predefined[13],
            $predefined[14],
            $predefined[15]
        ];
    }


}
