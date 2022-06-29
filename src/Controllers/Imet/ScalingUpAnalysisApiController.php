<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Api\Api;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ModularForms\Helpers\File\Zip;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use ReflectionException;
use Illuminate\Database\Eloquent\Collection;

class ScalingUpAnalysisApiController
{
    /**
     * @param Request $request
     * @return array
     * @throws ReflectionException|ErrorException
     */
    public function get_general_info(Request $request): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = $this->get_querystring_values($request);
        $items = $this->wdpa_id_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = $this->retrieve_form_ids($items);
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
        list($wdpa_ids, $years) = $this->get_querystring_values($request);
        $items = $this->wdpa_id_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = $this->retrieve_form_ids($items);
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
        list($wdpa_ids, $years) = $this->get_querystring_values($request);
        $items = $this->wdpa_id_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = $this->retrieve_form_ids($items);
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
        list($wdpa_ids, $years) = $this->get_querystring_values($request);
        $items = $this->wdpa_id_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = $this->retrieve_form_ids($items);
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
        list($wdpa_ids, $years) = $this->get_querystring_values($request);
        $items = $this->wdpa_id_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = $this->retrieve_form_ids($items);
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
        list($wdpa_ids, $years) = $this->get_querystring_values($request);
        $items = $this->wdpa_id_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = $this->retrieve_form_ids($items);
        $response = Api::get_key_elements_conservation($form_ids);
        App::setLocale($language);
        return $this->add_fields_to_response($response, $records);
    }

    /**
     * @param Request $request
     * @param $type
     * @return array
     * @throws ErrorException
     */
    public function get_analysis_ranking(Request $request, $type): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = $this->get_querystring_values($request);
        $items = $this->wdpa_id_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = $this->retrieve_form_ids($items);
        $func = $type . "_ranking";
        App::setLocale($language);
        $response = Api::$func($form_ids);
        return $this->add_fields_to_response($response, $records);
    }

    /**
     * @param Request $request
     * @param $type
     * @return array
     * @throws ErrorException
     */
    public function get_analysis_average(Request $request, $type): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = $this->get_querystring_values($request);
        $items = $this->wdpa_id_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = $this->retrieve_form_ids($items);
        $func = $type . "_average";
        App::setLocale($language);
        return Api::$func($form_ids);
    }

    /**
     * @param Request $request
     * @param $type
     * @return array
     * @throws ErrorException
     */
    public function get_analysis_radar(Request $request, $type): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = $this->get_querystring_values($request);
        $items = $this->wdpa_id_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = $this->retrieve_form_ids($items);
        $func = $type . "_radar";
        App::setLocale($language);
        $response = Api::$func($form_ids);
        return $this->add_fields_to_response($response, $records);
    }

    /**
     * @param Request $request
     * @param $type
     * @return array
     * @throws ErrorException
     */
    public function get_analysis_table(Request $request, $type): array
    {
        $language = $request->get('lang', 'en');
        list($wdpa_ids, $years) = $this->get_querystring_values($request);
        $items = $this->wdpa_id_to_form_id($wdpa_ids, $years);
        list($form_ids, $records) = $this->retrieve_form_ids($items);
        $func = $type . "_table";
        App::setLocale($language);
        $response = Api::$func($form_ids);
        return $this->add_fields_to_response($response, $records);
    }

    /**
     * @param Request $request
     * @return array
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
     */
    public function get_analysis_group_and_indicators_group(Request $request): array
    {
        $language = $request->get('lang', 'en');
        $items = $this->group_items($request);
        App::setLocale($language);
        return Api::get_grouping_analysis_by_indicators($items);
    }

    /**
     * @param Request $request
     * @return array
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

                $records = $this->wdpa_id_to_form_id($ids, $years);

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
            if (isset($records[$items['id']])) {
                $response['records'][$k]['year'] = $records[$items['id']]['Year'];
            }
        }
        return $response;
    }

    /**
     * @param array $ids
     * @param array $years
     * @return Collection
     * @throws ErrorException
     */
    private function wdpa_id_to_form_id(array $ids, array $years): Collection
    {
        $keys_not_match = [];
        if (count($years) === 0) {
            return Imet::select('FormID', 'Year', 'wdpa_id', 'Country')->whereIn('wdpa_id', $ids)->get();
        } else if (count($years) === 1) {
            return Imet::select('FormID', 'Year', 'wdpa_id', 'Country')->whereIn('wdpa_id', $ids)->where('Year', $years[0])->get();
        } else if (count($years) > 1) {
            if (count($years) === count($ids)) {
                $collection = new Collection();
                foreach ($ids as $key => $id) {
                    $record = Imet::select('FormID', 'Year', 'wdpa_id', 'Country')->where('wdpa_id', $id)->where('Year', $years[$key])->first();
                    if ($record) {
                        $collection->add($record);
                    } else {
                        $keys_not_match[] = str_replace('{1}',$years[$key] ,str_replace('{0}',$id ,trans('imet-core::api.scaling_up.error_messages.ids_and_years')));
                    }
                }
                if (!count($keys_not_match)) {
                    return $collection;
                } else {
                    throw new ErrorException(trans('imet-core::api.scaling_up.error_messages.no_combination_found') . implode(',', $keys_not_match));
                }
            } else {
                throw new ErrorException(trans('imet-core::api.scaling_up.error_messages.mismatch_wdpa_ids_years'));
            }
        }

        throw new ErrorException(trans('imet-core::api.scaling_up.error_messages.something_went_wrong'));
    }

    /**
     * @param Request $request
     * @return array[]
     * @throws ErrorException
     */
    private function get_querystring_values(Request $request): array
    {
        $years = [];

        $query_wdpa_ids = $request->get('wdpa_ids', null);
        $query_years = $request->get('years', null);
        if ($query_wdpa_ids) {
            $wdpa_ids = explode(',', $query_wdpa_ids);
        } else {
            throw new ErrorException(trans('imet-core::api.wdpa_ids_missing'));
        }

        if ($query_years) {
            $years = explode(',', $query_years);
        }

        return [$wdpa_ids, $years];
    }

    /**
     * @param $items
     * @return array
     */
    private function retrieve_form_ids($items): array
    {
        $records = [];
        $form_ids = [];
        foreach ($items as $item) {
            $form_ids[] = $item->FormID;
            $records[$item->wdpa_id] = $item->toArray();
        }
        return [$form_ids, $records];
    }
}
