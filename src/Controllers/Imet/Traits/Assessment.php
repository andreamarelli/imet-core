<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\Traits;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\Statistics\OEMCStatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V1ToV2StatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V2StatisticsService;
use Illuminate\Http\JsonResponse;

use function response;

trait Assessment
{

    public static function assessment($item, string $step = 'global', bool $labels= false): JsonResponse
    {
        $version = Imet::getVersion($item);
        if($version === Imet::IMET_V1){
            $stats = V1ToV2StatisticsService::get_assessment($item, $step);
        } elseif($version === Imet::IMET_V2){
            $stats = V2StatisticsService::get_assessment($item, $step);
        } elseif($version === Imet::IMET_OECM){
            $stats = OEMCStatisticsService::get_assessment($item, $step);
        }

        return response()->json($stats);
    }


    public static function score_class($value, $additional_classes=''): string
    {
        if($value===null){
            $class = 'score_no';
        } elseif($value===0){
            $class = 'score_danger';
        } elseif($value<34){
            $class = 'score_alert';
        } elseif($value<51){
            $class = 'score_warning';
        } else {
            $class = 'score_success';
        }
        return 'class="'.$class.' '.$additional_classes.'"';
    }

    public static function score_class_threats($value, $additional_classes=''): string
    {
        if($value===null){
            $class = 'score_no';
        } elseif($value<-51){
            $class = 'score_danger';
        } elseif($value<-34){
            $class = 'score_alert';
        } elseif($value<-1){
            $class = 'score_warning';
        } else {
            $class = 'score_success';
        }
        return 'class="'.$class.' '.$additional_classes.'"';
    }

}

