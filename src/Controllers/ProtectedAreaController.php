<?php

namespace AndreaMarelli\ImetCore\Controllers;

use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ModularForms\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProtectedAreaController extends Controller
{

    /**
     * Search by search string or country
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function search(Request $request): JsonResponse
    {
        $list = collect();
        if ($request->filled('search_key') || $request->filled('country')) {
            $list = ProtectedArea::searchByKeyOrCountry(
                $request->input('search_key'),
                $request->input('country'));
        }
        return response()->json(
            [
                'records' => $list->toArray(),
                'countries' => $list->pluck('country_name', 'country')
                    ->sort()
                    ->toArray()
            ]
        );
    }

    /**
     *  Get list of pairs of id/label as JSON
     */
    public static function get_labels(Request $request): JsonResponse
    {
        $pairs = [];

        if($request->filled('id')){

            // Retrieve IDs list: can be comma separated string or json array
            $ids = $request->input(['id']);
            $pas = json_validate($ids)
                ? json_decode($ids)
                : explode(',', $ids);

            // Retrieve labels
            foreach ($pas as $pa){
                if(is_numeric($pa)){
                    $pairs[] = [
                        'id' => $pa,
                        'label' => ProtectedArea
                            ::select(['wdpa_id', 'name'])
                            ->where('wdpa_id', $pa)
                            ->firstOrFail()
                            ->name
                    ];
                } else {
                    $pairs[] = [
                        'id' => $pa,
                        'label' => $pa
                    ];
                }
            }
        }
        return response()->json(
            [
                'records' => $pairs
            ]
        );
    }

}
