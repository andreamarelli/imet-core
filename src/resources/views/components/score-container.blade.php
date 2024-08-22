<?php
/** @var String $step */
/** @var int $item_id */
/** @var String $version */

?>

<div class="module-container">
    <div class="module-header">
        <div class="module-title">
            @lang('imet-core::common.steps_eval.management_effectiveness')
        </div>
    </div>
    <div class="module-body">
        @include('imet-core::components.scores', [
            'item_id' => $item_id,
            'step' => $step,
            'version' => $version
        ])
    </div>
</div>
