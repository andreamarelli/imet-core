<?php
use AndreaMarelli\ImetCore\Controllers\Imet\Controller as ImetController;
use AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller as OecmController;
?>

@extends('modular-forms::layouts.forms')

@section('content')

    @include('imet-core::components.breadcrumbs_and_page_title')

    <div class="welcome_container">
        <a class="welcome_button" href="{{ route(ImetController::ROUTE_PREFIX . 'index') }}">
            @lang('imet-core::common.imet_short')
            <div class="description">@lang('imet-core::common.imet')</div>
        </a>
        <a class="welcome_button" href="{{ route(OecmController::ROUTE_PREFIX . 'index') }}">
            @lang('imet-core::oecm_common.oecm_short')
            <div class="description">@lang('imet-core::oecm_common.oecm')</div>
        </a>
    </div>

@endsection

@push('scripts')
    <style>
        .welcome_container {
            display: flex;
            column-gap: 10px;
            justify-content: space-evenly;
        }

        .welcome_button {
            padding: 60px;
            background-color: #E5E5E5;
            color: #525252;
            border-radius: 4px;
            font-size: 3rem;
            width: 350px;
            text-align: center;
        }
        .welcome_button:hover{
            background-color: #737373;
            color: #D4D4D4;
            text-decoration: none;
        }
        .welcome_button .description{
            margin-top: 30px;
            display: block;
            font-size: 1.5rem;
            line-height: 1.7rem;
        }

    </style>
@endpush