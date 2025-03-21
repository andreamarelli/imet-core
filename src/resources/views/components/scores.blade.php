<?php
use ImetCore\Controllers\Imet\ApiController;
use ImetCore\Models\Imet;
use ImetCore\Services\Assessment\ImetAssessment;
use ImetCore\Services\Scores\Functions\_Scores;

/** @var String $step */
/** @var Imet\v1\Imet|Imet\v2\Imet|Imet\oecm\Imet $item */

$scores = $version === Imet\Imet::IMET_OECM ? ApiController::scores_oecm($item->getKey())->getData() : ApiController::scores($item->getKey())->getData();

$labels = ImetAssessment::get_scores_labels($item->version, $item->language);
?>

<div id="assessment_scores" class="{{ isset($radar_show) && $radar_show === false ? 'w-8/12 mt-5' : 'w-full' }}">
    <imet_scores current_step="{{ $step }}" :labels='@json($labels)' :store=store
        version="{{ $version }}" :render_radar="{{ $radar_show ?? 'true' }}"></imet_scores>
</div>

@push('scripts')
    <script type="module">
        window.AssessmentScores = (new window.ImetCore.Apps.AssessmentScores({
                api_data: @json($scores),
            }))
            .mount('#assessment_scores');
    </script>
@endpush
