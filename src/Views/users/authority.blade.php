<?php
/** @var \AndreaMarelli\ImetCore\Controllers\UsersController $controller */
/** @var string $role */
/** @var \Illuminate\Database\Eloquent\Collection $users_and_roles */

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::common.imet_short')
    ]])
@endsection


@section('content')

    @include('imet-core::users.__menu')

    <h1>{{ $role }}</h1>
    {{ dump($users_and_roles) }}

@endsection