<?php
/** @var String $modal_id */
?>

<div id="{{ $modal_id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <strong v-html="error_message">@lang('imet-core::common.modal.error')</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-nav" id="close-modal" data-dismiss="modal">
                    @uclang('modular-forms::common.close')
                </button>
            </div>
        </div>
    </div>
</div>
