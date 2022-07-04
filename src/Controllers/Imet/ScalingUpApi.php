<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Helpers\API\Common\Common;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Api\Api;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ModularForms\Helpers\File\Zip;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use ReflectionException;

Trait ScalingUpApi
{
    /**
     * @param Request $request
     * @return array
     * @throws ReflectionException|ErrorException
     */
    public function get_general_info(Request $request): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = Common::get_querystring_values($request);
        $items = Common::wdpa_id_and_year_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = Common::retrieve_form_ids($items);
        App::setLocale($language);
        return Api::get_general_info($form_ids);
    }

    /**
     * @param Request $request
     * @return array
     * @throws ErrorException
     */
    public function get_overall_ranking(Request $request): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = Common::get_querystring_values($request);
        $items = Common::wdpa_id_and_year_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = Common::retrieve_form_ids($items);
        App::setLocale($language);
        return Api::overall_ranking($form_ids);
    }

    /**
     * @param Request $request
     * @return array
     * @throws ErrorException
     */
    public function get_overall_average_of_six_elements(Request $request): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = Common::get_querystring_values($request);
        $items = Common::wdpa_id_and_year_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = Common::retrieve_form_ids($items);
        App::setLocale($language);
        return Api::overall_average_of_six_elements($form_ids);
    }

    /**
     * @param Request $request
     * @return array
     * @throws ErrorException
     */
    public function get_visualization_synthetics_indicators(Request $request): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = Common::get_querystring_values($request);
        $items = Common::wdpa_id_and_year_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = Common::retrieve_form_ids($items);
        App::setLocale($language);
        return Api::visualization_synthetics_indicators($form_ids);
    }

    /**
     * @param Request $request
     * @return array
     * @throws ErrorException
     */
    public function get_scatter_visualization_synthetic_indicators(Request $request): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = Common::get_querystring_values($request);
        $items = Common::wdpa_id_and_year_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = Common::retrieve_form_ids($items);
        App::setLocale($language);
        return Api::scatter_visualization_synthetic_indicators($form_ids);
    }

    /**
     * @param Request $request
     * @return array
     * @throws ErrorException
     */
    public function get_key_elements_conservation(Request $request): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = Common::get_querystring_values($request);
        $items = Common::wdpa_id_and_year_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = Common::retrieve_form_ids($items);
        App::setLocale($language);
        $response = Api::get_key_elements_conservation($form_ids);

        return $this->add_fields_to_response($response, $records);
    }

    /**
     * @param Request $request
     * @param string $type
     * @return array
     * @throws ErrorException
     */
    public function get_analysis_ranking(Request $request, string $slug): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = Common::get_querystring_values($request);
        $items = Common::wdpa_id_and_year_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = Common::retrieve_form_ids($items);
        $slug = str_replace('-', '_', $slug);
        $func = $slug . "_ranking";
        $response = $this->execute_function_url($form_ids, $func, $language);
        return $this->add_fields_to_response($response, $records);
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return array
     * @throws ErrorException
     */
    public function get_analysis_average(Request $request, string $slug): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = Common::get_querystring_values($request);
        $items = Common::wdpa_id_and_year_to_form_id($wdpa_ids, $years);

        list($form_ids, $records) = Common::retrieve_form_ids($items);
        $slug = str_replace('-', '_', $slug);
        $func = $slug . "_average";
        return $this->execute_function_url($form_ids, $func, $language);
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return array
     * @throws ErrorException
     */
    public function get_analysis_radar(Request $request, string $slug): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = Common::get_querystring_values($request);
        $items = Common::wdpa_id_and_year_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = Common::retrieve_form_ids($items);
        $slug = str_replace('-', '_', $slug);
        $func = $slug . "_radar";
        $response = $this->execute_function_url($form_ids, $func, $language);
        return $this->add_fields_to_response($response, $records);
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return array
     * @throws ErrorException
     */
    public function get_analysis_table(Request $request, string $slug): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = Common::get_querystring_values($request);
        $items = Common::wdpa_id_and_year_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = Common::retrieve_form_ids($items);
        $slug = str_replace('-', '_', $slug);
        $func = $slug . "_table";
        $response = $this->execute_function_url($form_ids, $func, $language);
        return $this->add_fields_to_response($response, $records);
    }

    /**
     * @param Request $request
     * @return array
     * @throws ErrorException
     */
    public function get_analysis_group(Request $request): array
    {
        $language = $request->get('lang', 'en');
        $items = $this->group_items($request);
        App::setLocale($language);
        return Api::get_grouping_analysis($items);
    }

    /**
     * @param Request $request
     * @return array
     * @throws ErrorException
     */
    public function get_analysis_group_and_indicators_group(Request $request): array
    {
        $language = $request->get('lang', 'en');
        $items = $this->group_items($request);
        App::setLocale($language);
        return Api::get_grouping_analysis_by_indicators($items);
    }

    /**
     * @param array $form_ids
     * @param string $func
     * @param string $language
     * @return array
     */
    private function execute_function_url(array $form_ids, string $func, string $language): array
    {
        $response = [];
        App::setLocale($language);
        if (method_exists(Api::class, $func)) {
            $response = Api::$func($form_ids);
        } else {
            abort(404, "Page not found");
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return array
     * @throws ErrorException
     */
    private function group_items(Request $request): array
    {
        $query = $request->collect()->all();
        $items = [];
        $group = 1;

        foreach ($query as $k => $item) {
            if (strpos($k, "group_") !== false) {
                $years = [];
                $keys = explode('_', $k);
                $years_keys = $request['years_' . $keys[1]];
                if ($years_keys) {
                    $years = explode(',', $years_keys);
                }
                $ids = explode(',', $item);

                $records = Common::wdpa_id_and_year_to_form_id($ids, $years);

                foreach ($records as $record) {
                    $items[] = [
                        "id" => (int)$record->FormID,
                        'group' => $group,
                        'name' => 'Group ' . $group
                    ];
                }
                $group++;
            }
        }

        return $items;
    }

    /**
     * @param array $response
     * @param array $records
     * @return array
     */
    private function add_fields_to_response(array $response, array $records): array
    {
        foreach ($response['records'] as $k => $items) {
            if (isset($records[$items['wdpa_id']])) {
                $response['records'][$k]['year'] = $records[$items['wdpa_id']]['Year'];
            }
        }
        return $response;
    }

}
