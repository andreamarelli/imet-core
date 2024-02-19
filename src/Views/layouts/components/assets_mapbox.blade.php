<?php
use AndreaMarelli\ImetCore\Helpers\Manifest;
use Illuminate\Support\Facades\App;

$debug = !App::environment('production');
$only_css = $only_css ?? false;

?>

{{-- Stylesheets--}}
<link rel="stylesheet" href="{{ Manifest::asset('mapbox.css', $debug) }}">

{{-- JavaScript--}}
@if(!$only_css)
    <script src="{{ Manifest::asset('mapbox.js', $debug) }}"></script>
@endif
