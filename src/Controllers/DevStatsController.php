<?php

namespace AndreaMarelli\ImetCore\Controllers;


use AndreaMarelli\ImetCore\Controllers\Imet\EvalController;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\ImetStatisticsService;
use AndreaMarelli\ModularForms\Controllers\FormController as BaseFormController;
use Illuminate\Http\Request;

class DevStatsController extends BaseFormController
{

    public function index(Request $request)
    {
        $assessments_v1 = Imet
            ::select((new Imet)->getKeyName())
            ->where('version', 'v1')
            ->get()
            ->pluck((new Imet)->getKeyName())
            ->toArray();

        $assessments_v2 = Imet
            ::select((new Imet)->getKeyName())
            ->where('version', 'v2')
            ->get()
            ->pluck((new Imet)->getKeyName())
            ->toArray();

        $v1_stats_from_db = [];
        $v1_stats_from_php = [];
        foreach ($assessments_v1 as $id){
            $v1_stats_from_db[$id] = EvalController::radar_assessment($id);
            $v1_stats_from_php[$id] = ImetStatisticsService::radar_assessment($id);

        }
        $v2_stats_from_db = [];
        $v2_stats_from_php = [];
        foreach ($assessments_v2 as $id){
            $v2_stats_from_db[$id] = EvalController::radar_assessment($id);
            $v2_stats_from_php[$id] = ImetStatisticsService::radar_assessment($id);
//            dd($v2_stats_from_db[$id], $v2_stats_from_php[$id]);
        }

        return view('imet-core::dev_stats', [

            'assessments_v1' => $assessments_v1,
            'v1_stats_from_db' => $v1_stats_from_db,
            'v1_stats_from_php' => $v1_stats_from_php,

            'assessments_v2' => $assessments_v2,
            'v2_stats_from_db' => $v2_stats_from_db,
            'v2_stats_from_php' => $v2_stats_from_php,
        ]);

    }

}