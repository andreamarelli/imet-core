<?php
/** @var string $row_type */
/** @var string $values */
/** @var string $index */
/** @var bool $synthetic_indicator */

$synthetic_indicator = $synthetic_indicator ?? false;

if($synthetic_indicator){
    $code = '';
    $title = '<b class="text-uppercase">'.trans('imet-core::common.synthetic_indicator').'</b>';
    $rating =  'synthetic_indicator';
} else {
    $code = isset($index) ? "{{ labels['".$index."'].code }}" : "{{ labels[index].code }}";
    $title = isset($index) ? "{{ labels['".$index."'].title }}" : "{{ labels[index].title }}";
    $rating =  isset($index) ? $values."['".$index."']" : $values."[index]";
}

if($row_type == '0_to_100'){
    $row_style = 'display: grid; grid-template-columns: calc(50% - 40px)  calc(50% + 40px);';
} else if($row_type == 'minus100_to_0'){
    $row_style = 'display: grid; grid-template-columns: calc(50% + 40px)  calc(50% - 40px);';
} else if($row_type == 'minus100_to_100'){
    $row_style = 'display: grid; grid-template-columns: 50% 50%;';
} else {
    $row_style = '';
}

$echo_rating = "{{ ".$rating." }}";

?>

<div class="histogram-row">

    <div class="histogram-row__code text-center"><b><?php echo $code; ?></b></div>
    <div class="histogram-row__title text-left"><?php echo $title; ?></div>
    <div class="histogram-row__value text-center"><b><?php echo $echo_rating; ?></b></div>
    <div class="histogram-row__progress-bar" style="{{ $row_style }}">

        @if($row_type==='0_to_100_full_width')
            <imet_progress_bar
                :value={!! $rating !!}
                :color=step_color
            ></imet_progress_bar>

        @elseif($row_type==='0_to_100')
            <div class="histogram-row__progress-bar__spacer"></div>
            <imet_progress_bar
                :value={!! $rating !!}
                :color=step_color
            ></imet_progress_bar>

        @elseif($row_type==='minus100_to_0')
            <imet_progress_bar
                :value={!! $rating !!}
                :color=step_color
                :min=-100
                :max=0
            ></imet_progress_bar>
            <div class="histogram-row__progress-bar__spacer"></div>

        @elseif($row_type==='minus100_to_100')
            <imet_progress_bar
                :value="{!! $rating !!}<0 ? {!! $rating !!} : null"
                :color=step_color
                :min=-100
                :max=null
            ></imet_progress_bar>
            <imet_progress_bar
                :value="{!! $rating !!}>0 ? {!! $rating !!} : null"
                :color=step_color
                :min=null
                :max=100
            ></imet_progress_bar>

        @endif

    </div>

</div>



