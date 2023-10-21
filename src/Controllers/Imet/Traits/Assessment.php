<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\Traits;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\Assessment\ImetAssessment;
use AndreaMarelli\ImetCore\Services\Assessment\OecmAssessment;
use AndreaMarelli\ImetCore\Services\Scores\Functions\OEMCScores;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;
use AndreaMarelli\ImetCore\Services\Scores\Functions\V1ToV2Scores;
use AndreaMarelli\ImetCore\Services\Scores\Functions\V2Scores;
use Illuminate\Http\JsonResponse;

use function response;

trait Assessment
{

    public static function assessment($item, string $step = _Scores::RADAR_SCORES): JsonResponse
    {
        $stats = ImetAssessment::get_assessment($item, $step);

        return response()->json($stats);
    }

    public static function assessment_oecm($item, string $step = _Scores::RADAR_SCORES): JsonResponse
    {
        $stats = OecmAssessment::get_assessment($item, $step);

        return response()->json($stats);
    }


    public static function score_class($value, $additional_classes=''): string
    {
        if($value===null){
            $class = 'score_no';
        } elseif($value <= -51){
            $class='score_danger_alert';
        } elseif($value < -33 && $value > -51){
            $class='score_danger_warning';
        } elseif($value <= 0){
            $class = 'score_danger';
        } elseif($value < 34){
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

