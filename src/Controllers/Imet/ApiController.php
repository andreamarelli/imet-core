<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;


use AndreaMarelli\ImetCore\Helpers\API\Common\Common;
use Illuminate\Http\Request;

class ApiController
{
    use ScalingUpApi;
    use Assessment;

    /**
     * @param Request $request
     * @return array
     * @throws ErrorException
     */
    public function get_pa_list(Request $request): array
    {
        $api = [];
        $language = $request->get('lang', 'en');
        $controller = new Controller();
        $items = $controller->get_list($request);
        foreach ($items as $item) {
            $country_name = "name_" . $language;
            $api[] = [
                'wdpa_id' => $item['wdpa_id'],
                'language' => $item['language'],
                'name' => $item['name'],
                'year' => $item['Year'],
                'iso3' => $item['Country'],
                'country' => $item->country->$country_name,
                'version' => $item['version']
            ];
        }

        return ['records' => $api];
    }

    /**
     * @param Request $request
     * @return array
     * @throws ErrorException
     */
    public function get_imet_statistics_radar(Request $request): array
    {
        $api = [];
        $labels = [];
        list($wdpa_ids, $years) = Common::get_querystring_values($request);
        $records = Common::wdpa_id_and_year_to_form_id($wdpa_ids, $years);

        foreach ($records as $record) {
            $item = array_merge([
                'wdpa_id' => $record['wdpa_id'],
                'year' => $record['Year'],
                'version' => $record['version'],

            ], static::radar_assessment($record['FormID']));
            $api[] = $item;
        }

        $assessment_labels = static::assessment_steps_labels();
        foreach ($assessment_labels as $key => $values) {
            foreach ($values['abbreviations'] as $abb_key => $value) {
                $labels[$key][$value] = $values['full'][$abb_key];
            }
        }

        return ['records' => $api, 'labels' => $labels];
    }
}
