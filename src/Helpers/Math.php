<?php

namespace ImetCore\Helpers;

class Math
{

    public static function records_average($records, $field)
    {
        $sum = $count = 0;
        foreach ($records as $record) {
            if ($record[$field] !== null && $record[$field] !== -99 && $record[$field] !== '-99') {
                $sum += intval($record[$field]);
                $count++;
            }
        }
        return $count > 0 ? ($sum / $count) : 0;
    }

}
