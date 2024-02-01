<?php

use \AndreaMarelli\ImetCore\Controllers;
use \AndreaMarelli\ImetCore\Models;

/** @var Controllers\Imet\v1\Controller|Controllers\Imet\v2\Controller|Controllers\Imet\oecm\Controller $controller */
/** @var integer $formID */
/** @var Models\Imet\v1\Modules\Component\ImetModule|Models\Imet\v2\Modules\Component\ImetModule $module */
/** @var Models\Imet\v1\Modules\Component\ImetModule|Models\Imet\v2\Modules\Component\ImetModule $module_class as String */

$modal_id = 'imet_'.$formID.'_'.$module_class::getShortClassName();
?>

<div style="display: inline-block;"
     data-toggle="tooltip" data-placement="top" data-original-title="@uclang('modular-forms::common.show')">
    <button type="button"
            class="btn-nav small"
            data-toggle="modal" data-target="#{{ $modal_id }}">
        {!! AndreaMarelli\ModularForms\Helpers\Template::icon('eye', 'white') !!}
    </button>
</div>

<div id="{{ $modal_id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title" style="font-size: 1.2em;">IMET #{{ $formID }}</b>
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times black"></i></button>
                <b style="font-size: 1.2em;">IMET #{{ $formID }}</b>
            </div>
            <div class="modal-body">
                <x-modular-forms::module.container
                        :controller="$controller"
                        :module="$module_class"
                        :formId="$formID"
                        :mode="\AndreaMarelli\ModularForms\View\Module\Container::MODE_SHOW"
                ></x-modular-forms::module.container>
            </div>
        </div>
    </div>
</div>
