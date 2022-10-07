<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Imet $item */

// Force Language
if ($item->language != \Illuminate\Support\Facades\App::getLocale()) {
    \Illuminate\Support\Facades\App::setLocale($item->language);
}

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::common.imet_short')
    ]])
@endsection

@section('admin_page_title')
    @lang('imet-core::common.imet')
@endsection

@section('content')

    @include('imet-core::components.heading', ['phase' => 'evaluation', 'type' => 'show'])

    {{--  Form Controller Menu --}}
    @include('modular-forms::page.steps', [
        'url' => action([\AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV1::class, 'show'], ['item' => $item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::v1_common.steps_eval.',
        'classes' => $classes ?? '',
        'steps' => $steps
    ])

    {{-- management effectiveness --}}
    @include('imet-core::v1.evaluation.management_effectiveness.management_effectiveness', [
        'item_id' => $item->getKey(),
        'step' => $step
    ])

    {{--  Modules (by step) --}}
    <div class="imet_modules">
        @foreach($item::modules()[$step] as $module)
            @include('modular-forms::module.show.container', [
                'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV1::class,
                'module_class' => $module,
                'form_id' => $item->getKey()])
        @endforeach
    </div>
@endsection
