<?php
/** @var String $version */

use AndreaMarelli\ModularForms\Helpers\Template;

if($version === \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V1){
    $controller = \AndreaMarelli\ImetCore\Controllers\Imet\v1\Controller::class;
} else if($version === \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V2){
    $controller = \AndreaMarelli\ImetCore\Controllers\Imet\v2\Controller::class;
} else {
    $controller = \AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller::class;
}

?>

<x-modular-forms::button.form.destroy-dialog :controller="$controller" :item="$item"></x-modular-forms::button.form.destroy-dialog>