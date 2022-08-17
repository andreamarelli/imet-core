<?php
/** @var \AndreaMarelli\ImetCore\Controllers\UsersController $controller */
/** @var \Illuminate\Database\Eloquent\Collection $role */

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::common.imet_short')
    ]])
@endsection


@if(!is_imet_environment())
    @section('admin_page_title')
        @lang('imet-core::common.imet')
    @endsection
@endif

@section('content')

    Hello

@endsection