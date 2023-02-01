<?php
/** @var bool $is_wdpa */

$is_wdpa = $is_wdpa ?? true;

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
         route('imet-core::index') => trans('imet-core::common.imet_short')
    ]])
@endsection


@section('content')

    @if($is_wdpa)
        @include('modular-forms::module.edit.container', [
            'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\oecm\ContextController::class,
            'module_class' => \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Create::class,
            'form_id' => null])
    @else
        @include('modular-forms::module.edit.container', [
           'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\oecm\ContextController::class,
           'module_class' => \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\CreateNonWdpa::class,
           'form_id' => null])
    @endif

@endsection
