<?php
use ImetCore\Controllers\Imet\ApiController;
/** @var array $scores */
/** @var array $labels */

?>

<table id="detailed_scores">

    <!-- context -->
     <tr>
        <td colspan="12" style="background-color: #e5e5e5">
            <h5>@lang('imet-core::common.steps_eval.context')</h5>
        </td>
    </tr>
    <tr>
        <td colspan="12">
            <h4>
                <div class="{!! \ImetCore\Controllers\Imet\ApiController::score_class($scores['context']['avg_indicator'], '') !!}">{{ $scores['context']['avg_indicator']  ?? ' - ' }}</div>
            </h4>
        </td>

    </tr>
    <tr>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['context']['C1'], 'assessment_label' => $labels['C1']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['context']['C3'], 'assessment_label' => $labels['C3']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['context']['C4'], 'assessment_label' => $labels['C4']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['context']['C2'], 'assessment_label' => $labels['C2']])
        <td colspan="8"></td>
    </tr>
    <tr>
        <td colspan="12"></td>
    </tr>

    <!-- planning -->
    <tr>
        <td colspan="12" style="background-color: #e5e5e5">
            <h5>@lang('imet-core::common.steps_eval.planning')</h5>
        </td>
    </tr>
    <tr>
        <td colspan="12">
            <h4>
                <div class="{!! \ImetCore\Controllers\Imet\ApiController::score_class($scores['planning']['avg_indicator'], '') !!}">{{ $scores['planning']['avg_indicator']  ?? ' - ' }}</div>
            </h4>
        </td>
    </tr>
    <tr>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['planning']['P1'], 'assessment_label' => $labels['P1']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['planning']['P2'], 'assessment_label' => $labels['P2']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['planning']['P3'], 'assessment_label' => $labels['P3']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['planning']['P4'], 'assessment_label' => $labels['P4']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['planning']['P5'], 'assessment_label' => $labels['P5']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['planning']['P6'], 'assessment_label' => $labels['P6']])
        <td colspan="6"></td>
    </tr>
    <tr>
        <td colspan="12"></td>
    </tr>

    <!-- inputs -->
    <tr>
        <td colspan="12" style="background-color: #e5e5e5">
            <h5>@lang('imet-core::common.steps_eval.inputs')</h5>
        </td>
    </tr>
    <tr>
        <td colspan="12">
            <h4>
                <div class="{!! \ImetCore\Controllers\Imet\ApiController::score_class($scores['inputs']['avg_indicator'], '') !!}">{{ $scores['inputs']['avg_indicator']  ?? ' - ' }}</div>
            </h4>
        </td>
    </tr>
    <tr>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['inputs']['I1'], 'assessment_label' => $labels['I1']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['inputs']['I2'], 'assessment_label' => $labels['I2']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['inputs']['I3'], 'assessment_label' => $labels['I3']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['inputs']['I4'], 'assessment_label' => $labels['I4']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['inputs']['I5'], 'assessment_label' => $labels['I5']])
        <td colspan="7"></td>
    </tr>
<tr>
        <td colspan="12"></td>
    </tr>

    <!-- process -->
    <tr>
        <td colspan="12" style="background-color: #e5e5e5">
            <h5>@lang('imet-core::common.steps_eval.process')</h5>
        </td>
    </tr>
    <tr>
        <td colspan="12">
            <h4>
                <div class="{!! \ImetCore\Controllers\Imet\ApiController::score_class($scores['process']['avg_indicator'], '') !!}">{{ $scores['process']['avg_indicator']  ?? ' - ' }}</div>
            </h4>
        </td>
    </tr>
    <tr>
        <td colspan="5" style="background-color: #e5e5e5">{{  trans('imet-core::oecm_common.assessment.PRA') }}
            <div>{{ $scores['process']['PRA'] ?? ' - ' }}</div>
        </td>
        <td colspan="2" style="background-color: #e5e5e5">{{  trans('imet-core::oecm_common.assessment.PRB') }}
            <div>{{ $scores['process']['PRB'] ?? ' - ' }}</div>
        </td>
        <td colspan="3" style="background-color: #e5e5e5">{{  trans('imet-core::oecm_common.assessment.PRC') }}
            <div>{{ $scores['process']['PRC'] ?? ' - ' }}</div>
        </td>
        <td colspan="2" style="background-color: #e5e5e5">{{  trans('imet-core::oecm_common.assessment.PRD') }}
            <div>{{ $scores['process']['PRD'] ?? ' - ' }}</div>
        </td>
    </tr>
    <tr>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR1'], 'assessment_label' => $labels['PR1']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR2'], 'assessment_label' => $labels['PR2']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR3'], 'assessment_label' => $labels['PR3']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR4'], 'assessment_label' => $labels['PR4']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR5'], 'assessment_label' => $labels['PR5']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR6'], 'assessment_label' => $labels['PR6']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR7'], 'assessment_label' => $labels['PR7']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR8'], 'assessment_label' => $labels['PR8']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR9'], 'assessment_label' => $labels['PR9']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR10'], 'assessment_label' => $labels['PR10']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR11'], 'assessment_label' => $labels['PR11']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['process']['PR12'], 'assessment_label' => $labels['PR12']])
    </tr>
    <tr>
        <td colspan="12"></td>
    </tr>

    <!-- outputs -->
    <tr>
        <td colspan="12" style="background-color: #e5e5e5">
            <h5>@lang('imet-core::common.steps_eval.outputs')</h5>
        </td>
    </tr>
    <tr>
        <td colspan="12">
            <h4>
                <div class="{!! \ImetCore\Controllers\Imet\ApiController::score_class($scores['outputs']['avg_indicator'], '') !!}">{{ $scores['outputs']['avg_indicator']  ?? ' - ' }}</div>
            </h4>
        </td>
    </tr>
    <tr>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['outputs']['OP1'], 'assessment_label' => $labels['OP1']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['outputs']['OP1'], 'assessment_label' => $labels['OP2']])
        <td colspan="10"></td>
    </tr>
    <tr>
        <td colspan="12"></td>
    </tr>

    <!-- outcomes -->
    <tr>
        <td colspan="12" style="background-color: #e5e5e5">
            <h5>@lang('imet-core::common.steps_eval.outcomes')</h5>
        </td>
    </tr>
    <tr>
        <td colspan="12">
            <h4>
                <div class="{!! \ImetCore\Controllers\Imet\ApiController::score_class($scores['outcomes']['avg_indicator'], '') !!}">{{ $scores['outcomes']['avg_indicator']  ?? ' - ' }}</div>
            </h4>
        </td>
    </tr>
    <tr>
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['outcomes']['OC1'], 'assessment_label' => $labels['OC1']])
        @include('imet-core::oecm.report.components.row_evaluation', ['assessment_value' => $scores['outcomes']['OC2'], 'assessment_label' => $labels['OC2']])
        <td colspan="10"></td>
    </tr>

</table>
