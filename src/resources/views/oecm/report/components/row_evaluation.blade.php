<?php
/** @var string $assessment_value */

/** @var string $assessment_label */
/** @var string $additional_classes [optional] */

/** @var boolean $threats [optional] */

use ImetCore\Controllers\Imet\ApiController;

$assessment_value   = $assessment_value ?? null;
$additional_classes = $additional_classes ?? null;
$threats            = $threats ?? false;
$colspan            = isset($colspan) ? "colspan=".$colspan : "";
$color_scores       = $color_scores ?? true;

$classes =$color_scores ? $threats
    ? ApiController::score_class_threats($assessment_value)
    : ApiController::score_class($assessment_value) : '';

?>

<td class="{!! $classes . ' ' . $additional_classes !!}" {!! $colspan !!}>{{  $assessment_label }}
    <div>{{ $assessment_value ?? ' - ' }}</div>
</td>
