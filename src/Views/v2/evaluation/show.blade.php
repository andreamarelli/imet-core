<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\v2\Imet $item */

// Force Language
if($item->language != \Illuminate\Support\Facades\App::getLocale()){
    \Illuminate\Support\Facades\App::setLocale($item->language);
}

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::form/common.imet_short')
    ]])
@endsection

@section('admin_page_title')
    @lang('imet-core::form/common.imet')
@endsection

@section('content')

    <h2>@lang_u('imet-core::form/common.evaluation_long')</h2>
    <div class="entity-heading">
        <div class="id">#{{ $item->getKey() }}</div>
        <div class="name">{{ $item->Name }}</div>
        <div class="location">{!! \AndreaMarelli\ImetCore\Helpers\Template::flag_and_name($item->Country) !!}</div>
    </div>

    {{--  Form Controller Menu --}}
    @include('modular-forms::page.steps', [
        'url' => action([\AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV2::class, 'show'], ['item' => $item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::form/v2/common.steps_eval.',
        'steps' => array_keys($item::modules())
    ])

    {{-- management effectiveness --}}
    @include('imet-core::v2.evaluation.management_effectiveness.management_effectiveness', [
        'item_id' => $item->getKey(),
        'step' => $step
    ])

    {{--  Modules (by step) --}}
    <div class="imet_modules">
        @foreach($item::modules()[$step] as $module)
            @include('modular-forms::module.show.container', [
                'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class,
                'module_class' => $module,
                'form_id' => $item->getKey()])
        @endforeach
    </div>

@endsection