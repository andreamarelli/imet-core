<?php
/** @var String $mapbox_token */
/** @var Boolean $script_files */

use AndreaMarelli\ModularForms\Helpers\Manifest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

$current_route_name = Route::currentRouteName();

$debug = !App::environment('production');

?>

<script src="{{ Manifest::asset('imet_core_index.js', $debug) }}"></script>
<link rel="stylesheet" href="{{ Manifest::asset('imet_core_index.css', $debug) }}">

<script>
    window.imet_routes = {
        'assessment': '{{ route('imet_core::api::assessment', ['item' => '__id__']) }}',
        'assessment_oecm': '{{ route('imet_core::api::assessment_oecm', ['item' => '__id__']) }}',
        'scaling_up_preview': '{{ route('imet-core::scaling_up_preview', ['id' => '__id__']) }}',
        'scaling_up_basket_add': '{{ route('imet-core::scaling_up_basket_add') }}',
        'scaling_up_basket_get': '{{ route('imet-core::scaling_up_basket_get') }}',
        'scaling_up_basket_all': '{{ route('imet-core::scaling_up_basket_all') }}',
        'scaling_up_basket_delete': '{{ route('imet-core::scaling_up_basket_delete', ['id' => '__id__']) }}',
        'scaling_up_basket_clear': '{{ route('imet-core::scaling_up_basket_clear') }}'
    };
</script>


<!-- mapbox -->
@if(Str::contains($current_route_name, 'imet-core::v1_report') ||
    Str::contains($current_route_name, 'imet-core::v2_report') ||
    Str::contains($current_route_name, 'imet-core::scaling_up'))
        @include('modular-forms::layouts.components.mapbox')
        <script>
            window.mapboxgl.accessToken = '{{ $mapbox_token }}';
        </script>
@endif
