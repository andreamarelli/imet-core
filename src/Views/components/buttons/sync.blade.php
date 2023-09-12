<?php
/** @var String $form_class */
/** @var String $item */

/** @var String $label */

use AndreaMarelli\ImetCore\Controllers\Imet;

$item = $item ?? 'item.FormID';
$label = $label ?? null;
$controller = Imet\ApiController::class;

$vue_item = $item ?? 'item.id';
$button_id = ':id="\'button_id_\' + ' . $vue_item . '"';
$modal_id = ':id="\'sync_modal_\' + ' . $vue_item . '"';
$modal_target = ':data-target="\'#sync_modal_\' + ' . $vue_item . '"';
$action = vueAction($controller, 'post_imet_another_server', $item);

$label = $label ?? null;
$icon = AndreaMarelli\ModularForms\Helpers\Template::icon('sync', 'white');

?>

<div style="display: inline-block;"
     data-toggle="tooltip" data-placement="top" data-original-title="@uclang('imet-core::common.synced.sync')">
    <button type="submit"
            {!! $button_id !!}
            class="btn-nav small "
            :class="sync_loading === {{ $vue_item }} ? 'blue': 'green'"
            data-toggle="modal" {!! $modal_target !!}>
        <div v-if="item.synced===true" >
            <i class="fa fa-check"></i>
        </div>
        <div class="standalone"  v-else-if="sync_loading === {{ $vue_item }}" >
            <i class="fa fa-spinner fa-spin green_dark"></i>
        </div>
        <div v-else>
            {!! $icon !!}
        </div>
        {{ $label }}
    </button>
</div>

<div {!! $modal_id !!} class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" v-if="sync_loading > 0">
            <div class="modal-body">
                <strong>@lang('imet-core::common.synced.sync_running')</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-nav" id="close-modal" data-dismiss="modal">
                    @uclang('modular-forms::common.close')
                </button>
            </div>
        </div>
        <div class="modal-content" v-else-if="item.synced===false">
            <div class="modal-body">
                <strong>@lang('imet-core::common.synced.confirm_sync')</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-nav" id="close-modal" data-dismiss="modal">
                    @uclang('modular-forms::common.close')
                </button>
                <button type="submit" class="btn-nav red"
                        @click="sync('{{$action}}', 'sync_modal_'+item.FormID, item.FormID, item )">
                    {!! AndreaMarelli\ModularForms\Helpers\Template::icon('sync', 'white') !!}
                    @uclang('imet-core::common.synced.sync')
                </button>
            </div>
        </div>
        <div class="modal-content"  v-else>
            <div class="modal-body">
                <strong>@lang('imet-core::common.synced.already_synced')</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-nav" id="close-modal" data-dismiss="modal">
                    @uclang('modular-forms::common.close')
                </button>
            </div>
        </div>
    </div>
</div>
