<?php
/** @var String $step */
/** @var int $item_id */
/** @var String $version */

use AndreaMarelli\ImetCore\Controllers\Imet\ApiController;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\Assessment\ImetAssessment;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;

$scores = $version === Imet::IMET_OECM
    ? ApiController::scores_oecm($item_id)->getData()
    : ApiController::scores($item_id)->getData();

$labels = ImetAssessment::get_indicators_labels($version);

?>

<div id="assessment_scores">
    <imet_scores
        current_step="{{ $step }}"
        :labels='@json($labels)'
        :store=store
    ></imet_scores>
</div>

@push('scripts')
    <script type="module">
        window.AssessmentScores = (new window.ImetCore.Apps.AssessmentScores({
            api_data: @json($scores),
        }))
            .mount('#assessment_scores');
    </script>
@endpush