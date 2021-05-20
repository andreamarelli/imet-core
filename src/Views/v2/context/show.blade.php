<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\v2\Imet $item */

// Force Language
if($item->language != \Illuminate\Support\Facades\App::getLocale()){
    \Illuminate\Support\Facades\App::setLocale($item->language);
}

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => !is_imet_environment(), 'links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('form/imet/common.imet_short')
    ]])
@endsection

@section('admin_page_title')
    @lang('form/imet/common.imet')
@endsection

@section('content')

    <h2>{{ ucfirst(trans('form/imet/common.context_long')) }}</h2>
    <div class="entity-heading">
        <div class="id">#{{ $item->getKey() }}</div>
        <div class="name">{{ $item->Name }}</div>
        <div class="location">{!! \AndreaMarelli\ImetCore\Helpers\Template::flag_and_name($item->Country) !!}</div>
    </div>

    {{--  Form Controller Menu --}}
    @include('modular-forms::page.steps', [
        'url' => action([\AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class, 'show'], ['item' => $item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'form/imet/v2/common.steps.',
        'steps' => array_keys($item::modules())
    ])

    {{--  Modules (by step) --}}
    <div class="imet_modules">
        @foreach($item::modules()[$step] as $module)
            @include('modular-forms::module.show.container', [
                'module_class' => $module,
                'form_id' => $item->getKey()])
        @endforeach
    </div>

@endsection
