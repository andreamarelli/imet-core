<?php
/** @var bool $is_wdpa */
$is_wdpa = $is_wdpa ?? true;
?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
         action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::common.imet_short')
    ]])
@endsection


@section('content')

    @if($is_wdpa)
        @include('modular-forms::module.edit.container', [
            'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class,
            'module_class' => \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\Create::class,
            'form_id' => null])
    @else
        @include('modular-forms::module.edit.container', [
           'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class,
           'module_class' => \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\CreateNonWdpa::class,
           'form_id' => null])
    @endif


@endsection
