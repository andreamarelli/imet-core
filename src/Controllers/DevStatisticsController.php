<?php

namespace AndreaMarelli\ImetCore\Controllers;


use AndreaMarelli\ImetCore\Controllers\Imet\EvalController;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\Statistics\StatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V1StatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V1ToV2StatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V2StatisticsService;
use AndreaMarelli\ModularForms\Controllers\FormController as BaseFormController;
use Illuminate\Http\Request;

class DevStatisticsController extends BaseFormController
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

        $labels = StatisticsService::assessment_steps_labels();


        $v1_stats_from_db = [];
        $v1_stats_from_php = [];
        foreach ($assessments_v1 as $id){
            $v1_stats_from_db['radar'][$id] = EvalController::radar_assessment($id);
            $v1_stats_from_php['radar'][$id] = array_combine(
                $labels['v1']['abbreviations'],
                V1ToV2StatisticsService::get_scores($id)
            );
            $v1_stats_from_db['context'][$id] = V1ToV2StatisticsService::db_scores_context($id);
            $v1_stats_from_php['context'][$id] = V1ToV2StatisticsService::scores_context($id);
            $v1_stats_from_db['planning'][$id] = V1ToV2StatisticsService::db_scores_planning($id);
            $v1_stats_from_php['planning'][$id] = V1ToV2StatisticsService::scores_planning($id);
            $v1_stats_from_db['inputs'][$id] = V1ToV2StatisticsService::db_scores_inputs($id);
            $v1_stats_from_php['inputs'][$id] = V1ToV2StatisticsService::scores_inputs($id);
            $v1_stats_from_db['process'][$id] = V1ToV2StatisticsService::db_scores_process($id);
            $v1_stats_from_php['process'][$id] = V1ToV2StatisticsService::scores_process($id);
            $v1_stats_from_db['outputs'][$id] = V1ToV2StatisticsService::db_scores_outputs($id);
            $v1_stats_from_php['outputs'][$id] = V1ToV2StatisticsService::scores_outputs($id);
            $v1_stats_from_db['outcomes'][$id] = V1ToV2StatisticsService::db_scores_outcomes($id);
            $v1_stats_from_php['outcomes'][$id] = V1ToV2StatisticsService::scores_outcomes($id);
        }

        $v2_stats_from_db = [];
        $v2_stats_from_php = [];
        foreach ($assessments_v2 as $id){
            $v2_stats_from_db['radar'][$id] = EvalController::radar_assessment($id);
            $v2_stats_from_php['radar'][$id] = array_combine(
                $labels['v2']['abbreviations'],
                V2StatisticsService::get_scores($id)
            );
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

    public static function radar_assessment(int $imet_id, $abbreviations = true)
    {
        $stats = static::assessment($imet_id, 'global', true);
        $values = [
            $stats["context"],
            $stats["planning"],
            $stats["inputs"],
            $stats["process"],
            $stats["outputs"],
            $stats["outcomes"]
        ];

        $labels = StatisticsService::assessment_steps_labels();
        return array_combine(
            $labels[$stats['version']][$abbreviations ? 'abbreviations' : 'full'],
            $values
        );
    }


    private static function assessment(int $imet_id, string $step = 'global', bool $labels = false): array
    {
        $imet = Imet::find($imet_id);

        if($imet->version === 'v1'){
            /** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Imet $imet */
            $stats = V1ToV2StatisticsService::get_scores($imet, $step);
        } else {
            /** @var \AndreaMarelli\ImetCore\Models\Imet\v2\Imet $imet */
            $stats = V2StatisticsService::get_scores($imet, $step);
        }

        return array_merge([
           'formid' => $imet->getKey(),
           'wdpa_id' => $imet->wdpa_id,
           'year' => $imet->Year,
           'iso3' => $imet->Country,
           'name' => $imet->name,
           'version' => $imet->version,
           'labels' => $labels ? StatisticsService::labels($imet->version) : null,
       ],
       $stats);
    }

}