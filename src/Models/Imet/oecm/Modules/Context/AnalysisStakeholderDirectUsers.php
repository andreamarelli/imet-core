<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use Illuminate\Http\Request;

/**
 * @property $titles
 */
class AnalysisStakeholderDirectUsers extends _AnalysisStakeholders
{
    protected $table = 'imet_oecm.context_analysis_stakeholders_direct_users';
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Stakeholder';
    protected static $DEPENDENCIES = [
        [Modules\Evaluation\KeyElements::class, 'Element']
    ];
    protected static $USER_MODE = Stakeholders::ONLY_DIRECT;

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'SA 2.1';
        $this->module_title = trans('imet-core::oecm_context.AnalysisStakeholderDirectUsers.title');
        $this->module_fields = [
            ['name' => 'Element',       'type' => 'blade-imet-core::oecm.context.fields.AnalysisStakeholdersElement', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'Description',    'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Description')],
            ['name' => 'Dependence',    'type' => 'imet-core::rating-0to3', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Dependence')],
            ['name' => 'Access',        'type' => 'suggestion-ImetOECM_Access', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Access')],
            ['name' => 'Rivalry',       'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Rivalry')],
            ['name' => 'Quality',    'type' => 'imet-core::rating-Minus2to2', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Quality')],
            ['name' => 'Quantity',    'type' => 'imet-core::rating-Minus2to2', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Quantity')],
            ['name' => 'Threats',      'type' => 'dropdown_multiple-ImetOECM_MainThreat', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Threats')],
            ['name' => 'Comments',      'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Comments')],
            ['name' => 'Stakeholder',    'type' => 'hidden', 'label' =>''],
        ];

        $this->module_groups = trans('imet-core::oecm_context.AnalysisStakeholders.groups');

        $this->module_info = trans('imet-core::oecm_context.AnalysisStakeholderDirectUsers.module_info');
        $this->ratingLegend = trans('imet-core::oecm_context.AnalysisStakeholderDirectUsers.ratingLegend');

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

        if($record['Description']!==null
            || $record['Dependence']!==null
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