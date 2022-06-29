<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Api\Analysis;

use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\DataTable as ScalingUpDataTable;

trait Data
{
    /**
     * @param array $items
     * @param array $indicators
     * @param string $type
     * @return array
     */
    private static function retrieve_data(array $items, array $indicators, string $type = 'context'): array
    {
        $api = [];
        $table = ScalingUpDataTable::get_datatable_analysis_indicators($items, $indicators, $type);

        foreach ($table['table'] as $key => $item) {
            $name = $item['name'];
            $id = $item['wdpa_id'];
            unset($item['name']);
            unset($item['wdpa_id']);
            $values = $item;
            $api[] = [
                'id' => $id,
                'name' => $name,
                'values' => $values
            ];
        }

        return [$api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function management_context_table(array $items): array
    {
        $indicators = [
            'c1' => 'C1: ' . trans('imet-core::analysis_report.assessment.c1'),
            'c2' => 'C2: ' . trans('imet-core::analysis_report.assessment.c2'),
            'c3' => 'C3: ' . trans('imet-core::analysis_report.assessment.c3')
        ];

        list($api) = static::retrieve_data($items, $indicators);


        return ['records' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function value_and_importance_sub_indicators_table(array $items): array
    {
        $indicators = [
            'c11' => 'C1.1: ' . trans('imet-core::analysis_report.assessment.c11'),
            'c12' => 'C1.2: ' . trans('imet-core::analysis_report.assessment.c12'),
            'c13' => 'C1.3: ' . trans('imet-core::analysis_report.assessment.c13'),
            'c14' => 'C1.4: ' . trans('imet-core::analysis_report.assessment.c14'),
            'c15' => 'C1.5: ' . trans('imet-core::analysis_report.assessment.c15')
        ];

        list($api) = static::retrieve_data($items, $indicators);


        return ['records' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function planning_indicators_table(array $items): array
    {
        $indicators = [
            'p1' => 'P1: ' . trans('imet-core::analysis_report.assessment.p1'),
            'p2' => 'P2: ' . trans('imet-core::analysis_report.assessment.p2'),
            'p3' => 'P3: ' . trans('imet-core::analysis_report.assessment.p3'),
            'p4' => 'P4: ' . trans('imet-core::analysis_report.assessment.p4'),
            'p5' => 'P5: ' . trans('imet-core::analysis_report.assessment.p5'),
            'p6' => 'P6: ' . trans('imet-core::analysis_report.assessment.p6')
        ];

        list($api) = static::retrieve_data($items, $indicators, 'planning');


        return ['records' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function inputs_indicators_table(array $items): array
    {
        $indicators = [
            'i1' => 'I1: ' . trans('imet-core::analysis_report.assessment.i1'),
            'i2' => 'I2: ' . trans('imet-core::analysis_report.assessment.i2'),
            'i3' => 'I3: ' . trans('imet-core::analysis_report.assessment.i3'),
            'i4' => 'I4: ' . trans('imet-core::analysis_report.assessment.i4'),
            'i5' => 'I5: ' . trans('imet-core::analysis_report.assessment.i5')
        ];

        list($api) = static::retrieve_data($items, $indicators, 'inputs');


        return ['records' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function outputs_indicators_table(array $items): array
    {
        $indicators = [
            'op1' => 'O/P1: ' . trans('imet-core::analysis_report.assessment.op1'),
            'op2' => 'O/P2: ' . trans('imet-core::analysis_report.assessment.op2'),
            'op3' => 'O/P3: ' . trans('imet-core::analysis_report.assessment.op3')
        ];

        list($api) = static::retrieve_data($items, $indicators, 'outputs');

        return ['records' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function outcomes_indicators_table(array $items): array
    {
        $indicators = [
            'oc1' => 'O/C1: ' . trans('imet-core::analysis_report.assessment.oc1'),
            'oc2' => 'O/C2: ' . trans('imet-core::analysis_report.assessment.oc2'),
            'oc3' => 'O/C3: ' . trans('imet-core::analysis_report.assessment.oc3'),
        ];

        list($api) = static::retrieve_data($items, $indicators, 'outcomes');

        return ['records' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_indicators_table(array $items): array
    {
        $indicators = [
            'pr15_16' => 'PR A: ' . trans('imet-core::analysis_report.assessment.pr15_16'),
            'pr10_12' => 'PR B: ' . trans('imet-core::analysis_report.assessment.pr10_12'),
            'pr13_14' => 'PR C: ' . trans('imet-core::analysis_report.assessment.pr13_14'),
            'pr17_18' => 'PR D: ' . trans('imet-core::analysis_report.assessment.pr17_18'),
            'pr1_6' => 'PR E: ' . trans('imet-core::analysis_report.assessment.pr1_6'),
            'pr7_9' => 'PR F: ' . trans('imet-core::analysis_report.assessment.pr7_9')
        ];

        list($api) = static::retrieve_data($items, $indicators, 'process');

        return ['records' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_internal_management_indicators_table(array $items): array
    {
        $indicators = [
            'pr1' => 'PR1: ' . trans('imet-core::analysis_report.assessment.pr1'),
            'pr2' => 'PR2: ' . trans('imet-core::analysis_report.assessment.pr2'),
            'pr3' => 'PR3: ' . trans('imet-core::analysis_report.assessment.pr3'),
            'pr4' => 'PR4: ' . trans('imet-core::analysis_report.assessment.pr4'),
            'pr5' => 'PR5: ' . trans('imet-core::analysis_report.assessment.pr5'),
            'pr6' => 'PR6: ' . trans('imet-core::analysis_report.assessment.pr6')
        ];

        list($api) = static::retrieve_data($items, $indicators, 'process');

        return ['records' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_management_protection_indicators_table(array $items): array
    {
        $indicators = [
            'pr7' => 'PR7: ' . trans('imet-core::analysis_report.assessment.pr7'),
            'pr8' => 'PR8: ' . trans('imet-core::analysis_report.assessment.pr8'),
            'pr9' => 'PR9: ' . trans('imet-core::analysis_report.assessment.pr9')
        ];

        list($api) = static::retrieve_data($items, $indicators, 'process');

        return ['records' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_stakeholders_relationships_indicators_table(array $items): array
    {
        $indicators = [
            'pr10' => 'PR10: ' . trans('imet-core::analysis_report.assessment.pr10'),
            'pr11' => 'PR11: ' . trans('imet-core::analysis_report.assessment.pr11'),
            'pr12' => 'PR12: ' . trans('imet-core::analysis_report.assessment.pr12')
        ];

        list($api) = static::retrieve_data($items, $indicators, 'process');

        return ['records' => $api, 'labels' => $indicators];
    }
}
