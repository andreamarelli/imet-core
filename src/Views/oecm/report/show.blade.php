<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\oecm\Imet $item */
/** @var array $assessment */
/** @var array $key_elements */
/** @var array $key_elements_biodiversity */
/** @var array $key_elements_ecosystem */
/** @var array $report */
/** @var array $wdpa_extent */
/** @var array $area */
/** @var bool  $show_api */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */
?>

@include('imet-core::oecm.report.report', [
    'action' => 'show',
    'assessment' => $assessment,
    'key_elements_ecosystem_charts' => $key_elements_ecosystem_charts,
    'key_elements_biodiversity_charts' => $key_elements_biodiversity_charts,
    'key_elements_biodiversity' => $key_elements_biodiversity,
    'key_elements_ecosystem' => $key_elements_ecosystem,
    'report' => $report,
    'report_schema' => $report_schema,
    'area' => $area,
    'show_non_wdpa' => $show_non_wdpa,
    'non_wdpa' => $non_wdpa,
    'type' => 'show'
])
