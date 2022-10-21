<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;

class DataTable
{
    public static function get_datatable_analysis_indicators(array $form_ids, array $table_indicators, string $type = "", int $scaling_id = 0)
    {
        $tables = [$type => []];

        $filtered = Common::filtered_indicators_and_round_values($form_ids, $type, $table_indicators);
        $idx = 0;
        foreach ($filtered as $id => $values) {
            $pa = Common::get_pa_name($id, $scaling_id);
            $protected_area = $pa->name;

            $tables[$type][$idx] = [];
            $tables[$type][$idx]['wdpa_id'] = $pa->wdpa_id;
            $tables[$type][$idx]['name'] = $protected_area;

            unset($values['indicators_number']);
            foreach ($values as $v => $value) {
                if ($v !== "avg") {
                    $tables[$type][$idx][$v] = Common::round_number($value);
                }
            }
            $idx++;
        }

        return [
            'table' => $tables[$type]
        ];
    }

}
