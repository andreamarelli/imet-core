<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Component;

use AndreaMarelli\ImetCore\Models\ProtectedArea;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Str;

/**
 * @method static conversionDataReview(array $record)
 * @method static conversionParameters()
 */
trait ConvertSQLite{

    /**
     * Convert ProtectedAreaID to WDPA from SQLITE knowledgebase
     *
     * @param $id
     * @param $sqlite_connection
     * @return string|null
     */
    public static function identifyProtectedAreaID($id, $sqlite_connection): ?string
    {
        $knowledge_base = $sqlite_connection->table('knowledgebase_protectedareas')
            ->select()
            ->where('id', $id)
            ->first();
        return $knowledge_base ? trim($knowledge_base->WDPA) : null;
    }

    /**
     * Identify PA (wdpa or name)
     *
     * @param $imet
     * @param $sqlite_connection
     * @return array|null[]
     */
    public static function conversionIdentifyPa($imet, $sqlite_connection): array
    {
        // Using ProtectedAreaID
        $wdpa = static::identifyProtectedAreaID($imet->ProtectedAreaID, $sqlite_connection);
        if(!empty($wdpa)
            && $pa = ProtectedArea::where('wdpa_id', $wdpa)->first()){
            return [$wdpa, $pa->name];
        }

        // Using "GeneralInfo" WDPA
        $generalInfo = $sqlite_connection->table('ProtectedAreas_GeneralInfo')
            ->select(['CompleteName', 'CompleteNameWDPA', 'UsedName', 'WDPA'])
            ->where('FormID', $imet->FormID)
            ->first();
        if($generalInfo){
            $wdpa = trim($generalInfo->WDPA);
            if(!empty($wdpa)
                && $pa = ProtectedArea::where('wdpa_id', $wdpa)->first()){
                return [$wdpa, $pa->name];
            }

            // NO valid WDPA: return only name (from "GeneralInfo")
            return [null, $generalInfo->CompleteNameWDPA
                ?? $generalInfo->CompleteName
                ?? $generalInfo->UsedName];
        }

        return [null, null];
    }



    /**
     * Execute conversion of OLD SQLite IMET to array
     *
     * @param $imet_data
     * @param \Illuminate\Database\ConnectionInterface $sqlite_connection
     * @return array
     */
    protected static function convert($imet_data, ConnectionInterface $sqlite_connection): array
    {
        if(!method_exists(get_called_class(), 'conversionParameters')){
            return [];
        }

        $sqlite_structure = static::conversionParameters();

        return $sqlite_connection->table('ProtectedAreas_'.$sqlite_structure['table'])
            ->select()
            ->where('FormID', $imet_data->FormID)
            ->where($sqlite_structure['query_condition'] ?? [])
            ->get()
            ->map(function($record) use ($sqlite_structure, $sqlite_connection){

                $record = (array) $record;
                // Review data from SQLITE whenever necessary
                if(method_exists(get_called_class(), 'conversionDataReview')){
                    $record = static::conversionDataReview($record, $sqlite_connection);
                }

                $json = [];
                // Match SQLite fields to current module fields
                $module_fields = (new static())->getModuleFieldsNames(['FILE_BINARY']);
                foreach ($module_fields as $field_idx => $field){
                    $sqlite_fields = $sqlite_structure['fields'];
                    //Find and import corresponding BYTEA field
                    if(Str::contains($field, '_BYTEA')){
                        $filename_field = Str::replace('_BYTEA', '', $field);
                        $filename_field_idx = array_search($filename_field, $sqlite_fields);
                        $sqlite_filename_field = $sqlite_fields[$filename_field_idx] . '_BYTEA';
                        array_splice( $sqlite_fields, $field_idx, 0, $sqlite_filename_field);
                    }
                    // Import corresponding field
                    if($sqlite_fields[$field_idx]!==null){
                        $json[$field] = $record[$sqlite_fields[$field_idx]];
                    }
                }
                // Additional fields
                $json[static::$foreign_key] = $record['FormID'];
                $json[static::UPDATED_AT] = $record['UpdateDate'];
                return $json;
            })
            ->toArray();
    }

}
