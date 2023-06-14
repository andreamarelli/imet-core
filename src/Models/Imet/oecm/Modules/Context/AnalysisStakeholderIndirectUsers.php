<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use Illuminate\Http\Request;

/**
 * @property $titles
 */
class AnalysisStakeholderIndirectUsers extends _AnalysisStakeholders
{
    protected $table = 'imet_oecm.context_analysis_stakeholders_indirect_users';
    public $titles = [];
    protected $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Stakeholder';
    protected static $DEPENDENCIES = [
        [Modules\Evaluation\KeyElements::class, 'Element']
    ];
    protected static $USER_MODE = Stakeholders::ONLY_INDIRECT;

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'SA 2.1';
        $this->module_title = trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.title');
        $this->module_fields = [
            ['name' => 'Element',       'type' => 'blade-imet-core::oecm.context.fields.ctx51_element', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'Description',   'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Description')],
            ['name' => 'Support',       'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Support')],
            ['name' => 'Guidelines',    'type' => 'suggestion-ImetOECM_Guidelines', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Guidelines')],
            ['name' => 'LackOfCollaboration',  'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.LackOfCollaboration')],
            ['name' => 'Status',    'type' => 'imet-core::rating-Minus2to2', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Status')],
            ['name' => 'Trend',    'type' => 'imet-core::rating-Minus2to2', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Trend')],
            ['name' => 'Threats',      'type' => 'dropdown_multiple-ImetOECM_MainThreat', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Threats')],
            ['name' => 'Comments',      'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Comments')],
            ['name' => 'Stakeholder',    'type' => 'hidden', 'label' =>''],
        ];

        $this->module_groups = trans('imet-core::oecm_context.AnalysisStakeholders.groups');
        $this->predefined_values = [
            'field' => 'Element',
            'values' => trans('imet-core::oecm_context.AnalysisStakeholders.predefined_values')
        ];

        $this->module_info = trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.module_info');
        $this->ratingLegend = trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.ratingLegend');

        parent::__construct($attributes);
    }

    public static function updateModule(Request $request): array
    {
        $return = parent::updateModule($request);
        $return['key_elements_importance'] = static::calculateKeyElementsImportances($return['id'], $return['records']);
        return $return;
    }

    /**
     * Override
     * @param $record
     * @param null $foreign_key
     * @return bool
     */
    public function isEmptyRecord($record, $foreign_key=null): bool
    {
        $isEmpty = true;

        if($record['Dependence']!==null
            || $record['Access']!==null
            || $record['Rivalry']===true
            || $record['Quality']===true
            || $record['Quantity']===true
            || $record['Threats']===true
            || $record['Comments']!==null
        ){
            $isEmpty = false;
        }

        return $isEmpty;
    }

    public static function calculateKeyElementImportance($item): ?float
    {
//        if($item['Dependence']!==null
//            || $item['Access']!==null
//            || $item['Rivalry']!==null
//                    || $item['Involvement']!==null
//                    || $item['Accountability']!==null
//                    || $item['Orientation']!==null
//        ){
//            $item['__importance'] = (
//                    3
//                    + ($item['Dependence'] ?? 0)
//                    + ($item['Rivalry'] ? 1 : 0) * 2
//                    - ($item['Involvement'] ? 1 : 0)
//                    - ($item['Accountability'] ? 1 : 0)
//                    - ($item['Orientation'] ? 1 : 0)
//                ) * 100 / 8;
//            return $item['__importance'] * $item['__stakeholder_weight'];
//        } else {
        return null;
//        }
    }


}
