<?php

namespace AndreaMarelli\ImetCore\Services;

trait Math
{
    private static function average($data): ?float
    {
        $sum = 0;
        $count_not_null = 0;
        foreach($data as $item){
            $sum += $item ?? 0;
            if($item !== null){
                $count_not_null++;
            }
        }
        return $count_not_null > 0
            ? round(($sum / $count_not_null), 2)
            : null;
    }


}