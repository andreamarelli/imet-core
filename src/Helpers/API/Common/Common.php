<?php

namespace AndreaMarelli\ImetCore\Helpers\API\Common;

use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class Common
{
    /**
     * @param array $ids
     * @param array $years
     * @return Collection
     * @throws ErrorException
     */
    public static function wdpa_id_and_year_to_form_id(array $ids, array $years): Collection
    {
        $fields = ['FormID', 'Year', 'wdpa_id', 'Country', 'version', 'name'];
        if (count($years) === 0) {
            return Imet::select($fields)->whereIn('wdpa_id', $ids)->get();
        } else if (count($years) === 1) {
            return Imet::select($fields)->whereIn('wdpa_id', $ids)->where('Year', $years[0])->get();
        } else if (count($years) > 1) {
            if (count($years) === count($ids)) {
                $keys_not_match = [];
                $collection = new Collection();
                foreach ($ids as $key => $id) {
                    $record = Imet::select($fields)->where('wdpa_id', $id)->where('Year', $years[$key])->first();
                    if ($record) {
                        $collection->add($record);
                    } else {
                        $keys_not_match[] = str_replace('{1}', $years[$key], str_replace('{0}', $id, trans('imet-core::api.scaling_up.error_messages.ids_and_years')));
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
    public static function get_querystring_values(Request $request): array
    {
        $years = [];
        $query_wdpa_ids = $request->get('wdpa_ids', null);
        $query_years = $request->get('years', null);

        if ($query_wdpa_ids) {
            $wdpa_ids = explode(',', $query_wdpa_ids);
        } else {
            throw new ErrorException(trans('imet-core::api.scaling_up.error_messages.wdpa_ids_missing'));
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
    public static function retrieve_form_ids($items): array
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
