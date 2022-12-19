<?php

namespace AndreaMarelli\ImetCore\Services;

use Illuminate\Support\Facades\DB;

trait DBFunctions
{
    private static function custom_db_function($imet_id, $function, $db_table): ?float
    {
        $function = static::SCHEMA . ".". $function ."('NOT_USED', '" . $db_table . "', '".$imet_id."')";
        $records = (array) DB::select(DB::raw('SELECT row_to_json(' . $function . ');'));
        return $records === []
            ? null
            : round(json_decode($records[0]->row_to_json, true)['value_p'], 2);
    }

    private static function table_db_function($imet_id, $db_table, $field): ?float
    {
        $function = static::SCHEMA . ".get_imet_evaluation_stats_table_all('NOT_USED', '" . $db_table . "', '".$field."',  '".$imet_id."')";
        $records = (array) DB::select(DB::raw('SELECT row_to_json(' . $function . ');'));
        return $records === []
            ? null
            : round(json_decode($records[0]->row_to_json, true)['value_p'], 2);
    }

}
