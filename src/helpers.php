<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

/**
 * check if imets can be synced to the global server
 * @return mixed
 */
function is_imet_synced_enabled()
{
    return env('SYNC_SERVER_URL');
}

/**
 * Check if App::environment is IMET related (ex. imetoffline or imetglobal)
 *
 * @return bool
 */
function is_imet_environment(): bool
{
    return App::environment('imetoffline')
        || App::environment('imetglobal');
}

/**
 * Check if App::environment is IMET related (ex. imetoffline or imetglobal)
 *
 * @return bool|string
 */
function imet_offline_version()
{
    return env('IMET_OFFLINE_VERSION');
}

/**
 * create a unique id for with wdpa_id and form_id
 *
 * @return bool|string
 */
function imet_sync_unique_id(int $wdpa_id, int $form_id)
{
    return sha1(str_replace('form_id', $form_id, str_replace('wdpa_id', $wdpa_id, env('UNIQUE_ID'))));
}

/**
 * Imet selection lists
 *
 * @param string $type
 * @return array
 */
function imet_selection_lists(string $type): array
{
    $list = [];

    if (Str::startsWith($type, 'ImetV1')
        || Str::startsWith($type, 'ImetV2')
        || Str::startsWith($type, 'Imet_')
        || Str::startsWith($type, 'OECM_')
        || Str::startsWith($type, 'ImetOECM_')) {
        preg_match("/Imet([\w\d]{0,2}|[\w\d]{0,4})\_([\w]+)/", $type, $matches);

        if ($matches[2] == "ProtectedArea") {
            $list = \AndreaMarelli\ImetCore\Models\ProtectedArea::selectionList();
        } elseif ($matches[2] == "Country") {
            $list = \AndreaMarelli\ImetCore\Models\Country::selectionList();
        } elseif ($matches[2] == "Currency") {
            $list = \AndreaMarelli\ImetCore\Models\Currency::imetV1List();
        } elseif ($matches[1] != "") {

            $list = trans('imet-core::' . strtolower($matches[1]) . '_lists.' . $matches[2]);
        }

    }

    return $list;
}
