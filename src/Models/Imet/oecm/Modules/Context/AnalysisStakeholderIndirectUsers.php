<?php

namespace ImetCore\Models\Imet\oecm\Modules\Context;

use ImetCore\Models\User\Role;
use ImetCore\Models\Imet\oecm\Modules;
use Illuminate\Http\Request;

/**
 * @property $titles
 */
class AnalysisStakeholderIndirectUsers extends _AnalysisStakeholders
{
    protected $table = 'context_analysis_stakeholders_indirect_users';

    public static $USER_MODE = Stakeholders::ONLY_INDIRECT;

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'SA 2.2';
        $this->module_title = trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.title');
        $this->module_fields = [
            ['name' => 'Element',       'type' => 'blade-imet-core::oecm.context.fields.AnalysisStakeholdersElement', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'Description',    'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Description')],
            ['name' => 'Illegal',    'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Illegal')],
            ['name' => 'Support',       'type' => 'rating-0to3', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Support')],
            ['name' => 'Guidelines',    'type' => 'suggestion-ImetOECM_Guidelines', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Guidelines')],
            ['name' => 'LackOfCollaboration',  'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.LackOfCollaboration')],
            ['name' => 'Status',    'type' => 'rating-Minus2to2', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Status')],
            ['name' => 'Trend',    'type' => 'rating-Minus2to2', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Trend')],
            ['name' => 'Threats',      'type' => 'dropdown_multiple-ImetOECM_Threats', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Threats')],
            ['name' => 'Comments',      'type' => 'text-area', 'label' => trans('imet-core::oecm_context.AnalysisStakeholderIndirectUsers.fields.Comments')],
            ['name' => 'Stakeholder',    'type' => 'hidden', 'label' =>''],
        ];
        $this->max_rows = 5;

        $this->module_groups = trans('imet-core::oecm_context.AnalysisStakeholders.groups');

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

        if($record['Description']!==null
            || $record['Support']!==null
            || $record['Guidelines']!==null
            || $record['LackOfCollaboration']===true
            || $record['Status']===true
            || $record['Trend']===true
            || $record['Threats']===true
            || $record['Comments']!==null
        ){
            $isEmpty = false;
        }

        return $isEmpty;
    }

    public static function calculateKeyElementImportance($item): ?float
    {
        if($item['Support']!==null
            || $item['Guidelines']!==null
            || $item['LackOfCollaboration']===true
            || $item['Status']!==null
            || $item['Trend']!==null
            || $item['Threats']!==null
        ){

            if($item['Guidelines']==='poorly_developed'){
                $guidelines = 2;
            } else if($item['Guidelines']==='moderately_developed'){
                $guidelines = 1;
            } else{
                $guidelines = 0;
            }

            $Threats = !empty($item['Threats']) ? json_decode($item['Threats']) : null;
            $Threats = is_array($Threats) ? count($Threats) : null;

            $max_score =
                3 // Support
                + 2 // Guidelines
                + 2 // LackOfCollaboration
                + 2 // Status
                + 2 // Trend
                + 12; // Threats

            $item['__importance'] = (
                4 +
                ($item['Support'] ?? 0) +
                $guidelines +
                ($item['LackOfCollaboration'] ? 2 : 0) -
                ($item['Status'] ?? 0) -
                ($item['Trend'] ?? 0) +
                ($Threats/3)
            ) * 100 / $max_score;

            return $item['__importance'] * $item['__stakeholder_weight'];
        } else {
            return null;
        }
    }

}
