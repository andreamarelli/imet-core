<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\Traits;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use function response;

trait Assessment
{

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

