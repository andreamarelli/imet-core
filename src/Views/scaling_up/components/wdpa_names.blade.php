<?php

use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpAnalysisController;
use AndreaMarelli\ModularForms\Helpers\Input\Input;

?>

<x-modular-forms::accordion.container class="form-filters">

    <x-modular-forms::accordion.item title="{{ Str::upper(trans('imet-core::analysis_report.custom_names')) }}">

        <form class="form-horizontal" method="GET" action="{{ action([ScalingUpAnalysisController::class, 'report'], ['items' => $pa_ids]) }}">
            {{ csrf_field() }}

            <div class="filters-grid">

                <div style="grid-column: span 3;">
                    <guidance :text="'imet-core::analysis_report.guidance.custom_names'"/>
                </div>
                @foreach($protected_areas['models'] as $key => $pa)
                    {!! Input::label('name', $pa->name, "exclude-element") !!}
                    {!! Input::text($pa->FormID, $custom_names[$pa->FormID] )!!}
                    <div>
                        <color_picker :text_box_name="{{$pa->FormID}}" :default_color="'{{$custom_colors[$pa->FormID]}}'"/>
                    </div>
                @endforeach
                {!! Input::hidden('save_form', 1) !!}

            </div>

            <div class="text-right">
                <button type="submit" class="btn-nav rounded">{{ Str::ucfirst(trans('imet-core::analysis_report.apply')) }}</button>
            </div>

        </form>

    </x-modular-forms::accordion.item>

</x-modular-forms::accordion.container>