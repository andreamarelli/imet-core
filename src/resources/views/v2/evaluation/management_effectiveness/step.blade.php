<?php

use AndreaMarelli\ImetCore\Services\Assessment\ImetAssessment;

/** @var String $step */
/** @var int $item_id */

$assessment_step = ImetAssessment::getAssessment($item_id, $step);

?>


<div id="assessment_step_{{ $step }}" class="assessment_step">
    <h5>@lang('imet-core::common.steps_eval.'.$step)</h5>


    @if($step=='context')

        {{-- C11->C15 statistics --}}
        <div style="margin-bottom: 20px;">
            <div v-for="(item, index) in intermediate_values">
                @include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => '0_to_100', 'values' => 'intermediate_values'])
            </div>
        </div>

        {{-- C1->C3 statistics --}}
        <div style="margin-bottom: 30px;">
            <div>@include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => '0_to_100', 'values' => 'values', 'index' => 'c1'])</div>
            <div>@include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => 'minus100_to_100', 'values' => 'values', 'index' => 'c2'])</div>
            <div>@include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => 'minus100_to_0', 'values' => 'values', 'index' => 'c3'])</div>
        </div>

    @elseif($step=='process')

        {{-- Step related statistics --}}
        <div style="margin-bottom: 20px;">
            <div v-for="(item, index) in values">
                @include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => '0_to_100_full_width', 'values' => 'values'])
            </div>
        </div>

        <div style="margin-bottom: 30px;">
            <div id="imet_process_radar" style="height: 250px;"></div>
        </div>

    @elseif($step=='outcomes')

        {{-- Step related statistics --}}
        <div style="margin-bottom: 20px;">
            <div>@include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => '0_to_100', 'values' => 'values', 'index' => 'oc1'])</div>
            <div>@include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => 'minus100_to_100', 'values' => 'values', 'index' => 'oc2'])</div>
            <div>@include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => 'minus100_to_100', 'values' => 'values', 'index' => 'oc3'])</div>
        </div>

    @else

        {{-- Step related statistics --}}
        <div style="margin-bottom: 30px;">
            <div v-for="(item, index) in values">
                @include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => '0_to_100_full_width', 'values' => 'values'])
            </div>
        </div>

    @endif

    {{-- Step synthetic indicator --}}
    <div style="padding-top: 20px; border-top: 1px solid #aaa;">
        <div>
            @include('imet-core::components.management_effectiveness.histogram_row', ['row_type' => '0_to_100_full_width', 'synthetic_indicator' => true])
        </div>
    </div>

</div>


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Assessment(
                @json([
                    'api_data' => $assessment_step,
                    'form_id' => $item_id,
                    'current_step' => $step
                ])
        )).mount('#assessment_step_{{ $step }}');
    </script>
@endpush