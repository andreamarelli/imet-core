<?php
/** @var String $step */
/** @var int $item_id */

use AndreaMarelli\ImetCore\Services\Assessment\ImetAssessment;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;

$assessment_scores = ImetAssessment::getAssessment($item_id, _Scores::ALL_SCORES);

?>

<div class="module-container" id="assessment_scores">
    <div class="module-header">
        <div class="module-title">
            @lang('imet-core::common.steps_eval.management_effectiveness')
        </div>
    </div>
    <div class="module-body">
        <imet_scores
            current_step="{{ $step }}"
            :api_data='@json($assessment_scores)'
        ></imet_scores>
    </div>
</div>

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.AssessmentScores())
            .mount('#assessment_scores');
    </script>
@endpush