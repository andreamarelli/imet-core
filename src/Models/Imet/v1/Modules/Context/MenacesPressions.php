<?php

namespace ImetCore\Models\Imet\v1\Modules\Context;

use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\User\Role;

class MenacesPressions extends Modules\Component\ImetModule
{
    protected $table = 'context_menaces_pressions';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public static $groupsByCategory = [
            ['group0'],
            ['group1', 'group2', 'group3', 'group4', 'group5'],
            ['group6'],
            ['group7'],
            ['group8', 'group9', 'group10', 'group11'],
            ['group12'],
            ['group13', 'group14', 'group15'],
            ['group16'],
            ['group17', 'group18', 'group19', 'group20', 'group21', 'group22'],
            ['group23'],
            ['group24'],
            ['group25'],
        ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 5.1';
        $this->module_title = trans('imet-core::v1_context.MenacesPressions.title');
        $this->module_fields = [
            ['name' => 'Value',         'type' => 'text-area',               'label' => trans('imet-core::v1_context.MenacesPressions.fields.Value')],
            ['name' => 'Impact',        'type' => 'rating-0to3',        'label' => trans('imet-core::v1_context.MenacesPressions.fields.Impact')],
            ['name' => 'Extension',     'type' => 'rating-0to3',        'label' => trans('imet-core::v1_context.MenacesPressions.fields.Extension')],
            ['name' => 'Duration',      'type' => 'rating-0to3',        'label' => trans('imet-core::v1_context.MenacesPressions.fields.Duration')],
            ['name' => 'Trend',         'type' => 'rating-Minus2to2',   'label' => trans('imet-core::v1_context.MenacesPressions.fields.Trend')],
            ['name' => 'Probability',   'type' => 'rating-0to3',        'label' => trans('imet-core::v1_context.MenacesPressions.fields.Probability')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_context.MenacesPressions.groups.group0'),
            'group1' => trans('imet-core::v1_context.MenacesPressions.groups.group1'),
            'group2' => trans('imet-core::v1_context.MenacesPressions.groups.group2'),
            'group3' => trans('imet-core::v1_context.MenacesPressions.groups.group3'),
            'group4' => trans('imet-core::v1_context.MenacesPressions.groups.group4'),
            'group5' => trans('imet-core::v1_context.MenacesPressions.groups.group5'),
            'group6' => trans('imet-core::v1_context.MenacesPressions.groups.group6'),
            'group7' => trans('imet-core::v1_context.MenacesPressions.groups.group7'),
            'group8' => trans('imet-core::v1_context.MenacesPressions.groups.group8'),
            'group9' => trans('imet-core::v1_context.MenacesPressions.groups.group9'),
            'group10' => trans('imet-core::v1_context.MenacesPressions.groups.group10'),
            'group11' => trans('imet-core::v1_context.MenacesPressions.groups.group11'),
            'group12' => trans('imet-core::v1_context.MenacesPressions.groups.group12'),
            'group13' => trans('imet-core::v1_context.MenacesPressions.groups.group13'),
            'group14' => trans('imet-core::v1_context.MenacesPressions.groups.group14'),
            'group15' => trans('imet-core::v1_context.MenacesPressions.groups.group15'),
            'group16' => trans('imet-core::v1_context.MenacesPressions.groups.group16'),
            'group17' => trans('imet-core::v1_context.MenacesPressions.groups.group17'),
            'group18' => trans('imet-core::v1_context.MenacesPressions.groups.group18'),
            'group19' => trans('imet-core::v1_context.MenacesPressions.groups.group19'),
            'group20' => trans('imet-core::v1_context.MenacesPressions.groups.group20'),
            'group21' => trans('imet-core::v1_context.MenacesPressions.groups.group21'),
            'group22' => trans('imet-core::v1_context.MenacesPressions.groups.group22'),
            'group23' => trans('imet-core::v1_context.MenacesPressions.groups.group23'),
            'group24' => trans('imet-core::v1_context.MenacesPressions.groups.group24'),
            'group25' => trans('imet-core::v1_context.MenacesPressions.groups.group25'),
        ];

        $this->predefined_values = [
            'field' => 'Value',
            'values' => [
                'group0' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group0'),
                'group1' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group1'),
                'group2' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group2'),
                'group3' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group3'),
                'group4' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group4'),
//                'group5' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group5'),
                'group6' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group6'),
                'group7' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group7'),
                'group8' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group8'),
                'group9' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group9'),
                'group10' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group10'),
                'group11' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group11'),
                'group12' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group12'),
                'group13' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group13'),
                'group14' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group14'),
//                'group15' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group15'),
                'group16' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group16'),
                'group17' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group17'),
                'group18' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group18'),
                'group19' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group19'),
                'group20' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group20'),
                'group21' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group21'),
                'group22' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group22'),
                'group23' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group23'),
                'group24' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group24'),
                'group25' => trans('imet-core::v1_context.MenacesPressions.predefined_values.group25'),
            ]
        ];
        $this->ratingLegend = trans('imet-core::v1_context.MenacesPressions.ratingLegend');

        parent::__construct($attributes);
    }

    public static function getVueData($form_id, $records, $definitions): array
    {
        $vue_data = parent::getVueData($form_id, $records, $definitions);
        $vue_data['groupsByCategory'] = static::$groupsByCategory;
        return $vue_data;
    }

    public static function getStats($form_id)
    {
        $records = static::getModuleRecords($form_id)['records'];
        $fields = ['Impact', 'Extension', 'Duration', 'Trend', 'Probability'];

        // ### row stats ###
        $row_stats = [];
        foreach ($records as $record){
            $valuesByRecord = [];
            foreach ($fields as $field){
                $valuesByRecord[] = $record[$field];
            }
            $row_stats[$record[static::$group_key_field]][] = static::calculateStats($valuesByRecord, true);
        }

        // ### group stats ###
        $group_stats = [];
        foreach ($row_stats as $group=>$values){
            $group_stats[$group] = static::calculateStats($values);
        }

        // ### category stats ###
        $category_stats = [];
        $valuesByCategory = [];
        foreach (static::$groupsByCategory as $index=>$groups){
            $valuesByCategory[$index] = [];
            foreach ($groups as $group){
                $valuesByCategory[$index][] = array_key_exists($group, $group_stats) ? $group_stats[$group] : null;
            }
        }
        foreach ($valuesByCategory as $values){
            $category_stats[] = static::calculateStats($values);
        }


        return [
            'row_stats' => $row_stats,
            'group_stats' => $group_stats,
            'category_stats' => $category_stats,
        ];
    }

    private static function calculateStats($values, $rows=false)
    {
        $numCategories = 4;
        $prod = 1;
        $count = 0;

        foreach ($values as $index=>$value){
            if($value!==null){
                if($index===3 && $rows===true){
                    $prod *= ($numCategories+1)/2 - $value*($numCategories-1)/4;
                } else {
                    $prod *= $numCategories - $value;
                }
                $count++;
            }
        }

        return $count>0
            ? (4 - round(pow($prod, 1/($count)),2))
            : null;
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'MenacesPressions',
            'fields' => [
                'Value', 'Impact', 'Extension', 'Duration', 'Trend', 'Probability', 'GroupValue'
            ]
        ];
    }

    /**
     * Review data from SQLITE
     *
     * @param $record
     * @param $sqlite_connection
     * @return array
     */
    protected static function conversionDataReview($record, $sqlite_connection): array
    {
        return static::convertGroupLabelToKey($record, 'GroupValue');
    }

}
