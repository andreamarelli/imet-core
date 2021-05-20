@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => !is_imet_environment(), 'links' => [
         action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('form/imet/common.imet_short')
    ]])
@endsection

@if(!is_imet_environment())
    @section('admin_page_title')
        @lang('form/imet/common.imet')
    @endsection
@endif

@section('content')

    @include('modular-forms::module.edit.container', [
        'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class,
        'module_class' => \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\Create::class,
        'form_id' => null])


@endsection
