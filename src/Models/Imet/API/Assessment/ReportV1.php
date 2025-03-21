<?php

namespace ImetCore\Models\Imet\API\Assessment;

use ImetCore\Models\Animal;
use ImetCore\Models\Imet\Imet;
use ImetCore\Services\Scores\ImetScores;
use ImetCore\Models\Imet\v1\Modules\Context\Areas;
use ImetCore\Models\Imet\v1\Modules\Context\GeneralInfo;
use ModularForms\Helpers\API\DOPA\DOPA;
use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\Imet\v1\Report;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReportV1
{
    protected static string $report_class = Report::class;
    protected static string $general_info_class = GeneralInfo::class;
    protected static string $areas_class = Areas::class;

    /**
     * @param Request $request
     * @param $form
     * @return array
     * @throws \ReflectionException
     */
    public static function get_assessment_report(Request $request, $form): array
    {
        $form_id = $form->getKey();
        $dopa_radar = null;

        $api_available = DOPA::apiAvailable();
        if ($api_available) {
            $dopa_radar = DOPA::get_wdpa_radarplot($form->wdpa_id, true)->records;
            $dopa_indicators = DOPA::get_wdpa_all_inds($form->wdpa_id)->records;
        }

        $general_info = static::get_general_info($form_id);

        $report = static::get_report($form_id);

        $vision = static::get_vision($form_id);

        $lang = $request->route('lang', 'en');
        App::setLocale($lang);

        $labels = static::get_labels();

        return [
            'data' => [
                'key_elements' => static::get_key_elements($form_id),
                'scores' => ImetScores::get_all($form_id),
                'labels' => ImetScores::indicators_labels(Imet::IMET_V1),
                'report' => $report,
                'dopa_radar' => $dopa_radar,
                'dopa_indicators' => $dopa_indicators[0] ?? null,
                'general_info' => $general_info,
                'vision' => $vision,
                'area' => static::get_area($form_id)
            ],
            'labels' => $labels
        ];
    }

    /**
     * @param int $form_id
     * @return float|int|null
     */
    protected static function get_area(int $form_id)
    {
        return static::$areas_class::getArea($form_id);
    }

    /**
     * @param int $form_id
     * @return array
     */
    protected static function get_report(int $form_id): array
    {
        $report = static::$report_class::getByForm($form_id);
        return static::remove_fields($report, ['id' => '', 'FormID' => '', 'UpdateDate' => '', 'UpdateBy' => '']);
    }

    /**
     * @param int $form_id
     * @return array
     * @throws \ReflectionException
     */
    protected static function get_general_info(int $form_id): ?array
    {
        $general_info = static::$general_info_class::getModuleRecords($form_id)[][0] ?? null;
        if ($general_info) {
            return static::remove_fields($general_info, ['WDPA' => '', 'id' => '', 'FormID' => '', 'UpdateDate' => '', 'UpdateBy' => '']);
        }

        return null;
    }

    /**
     * @param int $form_id
     * @return array
     * @throws \ReflectionException
     */
    protected static function get_vision(int $form_id): ?array
    {
        $vision = static::$general_info_class::getModuleRecords($form_id)[0] ?? null;
        if ($vision) {
            return static::remove_fields($vision, ['WDPA' => '', 'id' => '', 'FormID' => '', 'UpdateDate' => '', 'UpdateBy' => '']);
        }

        return null;
    }

    /**
     * @param int $form_id
     * @return array
     */
    protected static function get_key_elements(int $form_id): array
    {
        return [
            'species' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })->pluck('Aspect')->map(function ($item) {
                return Str::contains('|', $item) ? Animal::getByTaxonomy($item)->binomial : $item;
            })->toArray(),
            'habitats' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })->pluck('Aspect')->toArray(),
            'climate_change' => Modules\Evaluation\ImportanceClimateChange::getModule($form_id)->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })->pluck('Aspect')->toArray(),
            'ecosystem_services' => Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })->pluck('Aspect')->toArray(),
            'threats' => Modules\Evaluation\Menaces::getModule($form_id)->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })->pluck('Aspect')->toArray(),
        ];
    }

    /**
     * @return array
     */
    protected static function get_labels(): array
    {
        $general_info_labels = trans('imet-core::v1_context.GeneralInfo.fields');
        $steps_eval_labels = trans('imet-core::v1_common.steps_eval');
        $mission_labels = Lang::get('imet-core::v1_context.Missions.fields');
        $assessment_labels = Lang::get('imet-core::analysis_report.assessment');

        unset($general_info_labels['WDPA']);
        unset($steps_eval_labels['management_effectiveness']);
        unset($steps_eval_labels['general_info']);
        unset($assessment_labels['ctx101']);
        unset($assessment_labels['ctx102']);

        return array_merge($steps_eval_labels, $general_info_labels, $mission_labels, $assessment_labels);
    }

    /**
     * @param array $values
     * @param array $fields_to_extract
     * @return array
     */
    protected static function remove_fields(array $values, array $fields_to_extract = ['name' => '', 'iso3' => '', 'form_id' => '', 'wdpa_id' => '', 'year' => '', 'version' => '']): array
    {
        return array_diff_key($values, $fields_to_extract);
    }

}
