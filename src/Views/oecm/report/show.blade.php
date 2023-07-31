<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\oecm\Imet $item */
/** @var array $assessment */
/** @var array $key_elements */
/** @var array $report */
/** @var array $area */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */
?>

@include('imet-core::oecm.report.report', [
    'action' => 'show',
    'assessment' => $assessment,
    'key_elements' => $key_elements,
    'report' => $report,
    'area' => $area,
    'show_non_wdpa' => $show_non_wdpa,
    'non_wdpa' => $non_wdpa,
    'type' => 'show'
])
