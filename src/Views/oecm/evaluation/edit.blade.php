<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\oecm\Imet $item */

use AndreaMarelli\ImetCore\Models\User\Role;

// Force Language
if ($item->language != \Illuminate\Support\Facades\App::getLocale()) {
    \Illuminate\Support\Facades\App::setLocale($item->language);
}

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
        route('imet-core::index') => trans('imet-core::common.imet_short')
    ]])
@endsection


@section('content')

    @include('imet-core::components.heading', ['phase' => 'evaluation'])

    {{--  Form Controller Menu --}}
    @include('modular-forms::page.steps', [
        'url' => route(\AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller::ROUTE_PREFIX . 'eval_edit', ['item'=>$item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::common.steps_eval.',
        'steps' => array_keys($item::modules())
    ])


    {{-- management effectiveness --}}
    @include('imet-core::oecm.evaluation.management_effectiveness.management_effectiveness', [
        'item_id' => $item->getKey(),
        'step' => $step
    ])

    {{--  Modules (by step)--}}
    <div class="imet_modules">
        @foreach($item::modules()[$step] as $module)
            @if(Role::hasRequiredAccessLevel($module))
                @include('modular-forms::module.edit.container', [
                    'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\oecm\EvalController::class,
                    'module_class' => $module,
                    'form_id' => $item->getKey()])
            @else
                @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
            @endif
        @endforeach
    </div>

    {{--  Scroll buttons  --}}
    @include('modular-forms::buttons.scroll', ['item' => $item, 'step' => $step])


@endsection