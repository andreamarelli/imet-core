<?php
/** @var \AndreaMarelli\ImetCore\Controllers\Imet\Controller $controller */
/** @var \Illuminate\Database\Eloquent\Collection $list */
/** @var \Illuminate\Http\Request $request */
/** @var array $countries */
/** @var array $years */
/** @var boolean $filter_selected */

use AndreaMarelli\ImetCore\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

$can_encode = User::isAdmin(Auth::user()) || Role::isEncoder(Auth::user());
$url        = URL::route('index');
?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('admin.components.breadcrumbs', ['links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::form/imet/common.imet_short')
    ]])
@endsection

@if(!is_imet_environment())
@section('admin_page_title')
    @lang('imet-core::form/imet/common.imet')
@endsection
@endif

@section('content')

    @if($can_encode)

        @component('admin.components.functional_buttons')
            @slot('buttons')
                {{-- Import json IMETs --}}
                <a class="btn-nav rounded" href="{{ action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'import']) }}">
                    {!! \AndreaMarelli\ImetCore\Helpers\Template::icon('file-import', 'white') !!}
                    {{ ucfirst(trans('common.import')) }}
                </a>
                {{-- Export json IMETs --}}
                <a class="btn-nav rounded" href="{{ action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'export_view']) }}">
                    {!! \AndreaMarelli\ImetCore\Helpers\Template::icon('file-export', 'white') !!}
                    {{ ucfirst(trans('common.export')) }}
                </a>
                {{-- Create new IMET --}}
                @include('admin.components.buttons.create', [
                    'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class,
                    'label' => trans('imet-core::form/imet/v2/context.Create.title')
                ])
                <a class="btn-nav rounded" href="{{ action([\AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class, 'create_non_wdpa']) }}">
                    {!! \AndreaMarelli\ImetCore\Helpers\Template::icon('plus-circle', 'white') !!}
                    {{ ucfirst(trans('imet-core::form/imet/v2/context.CreateNonWdpa.title')) }}
                </a>
            @endslot
        @endcomponent

    @endif

    @include('imet-core::components.common_filters', [
        'request'=>$request,
        'url' => $url,
        'filter_selected' => $filter_selected,
        'countries' => $countries,
        'years' => $years
    ])

    <br />
    <div id="sortable_list">

        @include('admin.components.table.sort_on_client.num_records')

        <table class="striped">
            <thead>
            <tr>
                <th class="text-center width60px">@lang('entities.common.id')</th>
                @include('admin.components.table.sort_on_client.th', ['column' => 'Year', 'label' => trans('entities.common.year'), 'class' => 'width90px'])
                @include('admin.components.table.sort_on_client.th', ['column' => 'name', 'label' => trans_choice('entities.protected_area.protected_area', 1)])
                <th class="text-center">@lang('imet-core::form/imet/common.encoders_responsible')</th>
                <th>{{-- radar --}}</th>
                <th class="width200px">{{-- actions --}}</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="item of items">
                <td class="align-baseline text-center">#@{{ item.FormID }}</td>
                <td class="align-baseline text-center"><strong>@{{ item.Year }}</strong></td>
                <td class="align-baseline">

                    <div class="imet_name">
                        <div class="imet_pa_name">
                            {{-- name --}}
                            <strong style="font-size: 1.1em;">@{{ item.name }}</strong>
                            {{-- wdpa_id --}}
                            <span v-if="item.wdpa_id!==null">
                                (<a target="_blank" :href="'{{ \AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet::WEBSITE_URL }}'+ item.wdpa_id">@{{ item.wdpa_id }}</a>)
                            </span>
                            <br />
                            {{-- country --}}
                            <flag :iso2=item.country.iso2></flag>&nbsp;&nbsp;<i>@{{ item.country.name }}</i>
                        </div>
                        <br />
                        {{-- language --}}
                        <div>
                            {{ ucfirst(trans('imet-core::form/imet/common.encoding_language')) }}:
                            <flag :iso2=item.language></flag>
                        </div>
                        {{-- version --}}
                        <div>
                            {{ ucfirst(trans('common.version')) }}:
                            <span v-if="item.version==='v2'" class="badge badge-success">v2</span>
                            <span v-else-if="item.version==='v1'" class="badge badge-secondary">v1</span>
                        </div>
                    </div>
                </td>
                <td class="align-baseline">
                    <imet_encoders_responsibles
                        :items=item.encoders_responsibles
                    ></imet_encoders_responsibles>
                </td>
                <td>
                    <imet_radar :width=150 :height=150 :values=item.assessment_radar ></imet_radar>
                </td>
                <td class="align-baseline text-center" style="white-space: nowrap;">

                    {{-- Show --}}
                    <span v-if="item.version==='v2'">
                            @include('imet-core::components.button_show', ['version' => 'v2'])
                        </span>

                    @if($can_encode)

                        {{-- Edit --}}
                        <span v-if="item.version==='v1'">
                                {{-- Edit --}}
                            @include('imet-core::components.button_edit', ['version' => 'v1'])
                            </span>
                        <span v-else-if="item.version==='v2'">
                                {{-- Edit --}}
                            @include('imet-core::components.button_edit', ['version' => 'v2'])
                            </span>

                        {{-- Merge tool --}}
                        <span v-if="item.has_duplicates">
                                @include('admin.components.buttons._generic', [
                                    'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\Controller::class,
                                    'action' =>'merge_view',
                                    'item' => 'item.FormID',
                                    'tooltip' => ucfirst(trans('common.merge')),
                                    'icon' => 'clone',
                                    'class' => 'btn-primary'
                                ])
                            </span>

                    @endif

                    {{-- Export --}}
                    @include('admin.components.buttons._generic', [
                        'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\Controller::class,
                        'action' =>'export',
                        'item' => 'item.FormID',
                        'tooltip' => ucfirst(trans('common.export')),
                        'icon' => 'cloud-download-alt',
                        'class' => 'btn-primary'
                    ])

                    {{-- Print --}}
                    <span v-if="item.version==='v2'">
                            @include('admin.components.buttons._generic', [
                                'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class,
                                'action' =>'print',
                                'item' => 'item.FormID',
                                'tooltip' => ucfirst(trans('common.print')),
                                'icon' => 'print',
                                'class' => 'btn-primary'
                            ])
                        </span>

                    @if($can_encode)

                        {{-- Delete --}}
                        @include('admin.components.buttons.delete', [
                            'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\Controller::class,
                            'item' => 'item.FormID'
                        ])

                    @endif

                </td>
            </tr>
            </tbody>

        </table>

    </div>

    @push('scripts')

        <script>

            new SortedTable({
                el: '#sortable_list',
                data: {
                    list: @json($list),
                    pageSize: 10
                },

                mounted: function () {
                    this.sort('{{ \AndreaMarelli\ImetCore\Models\Imet\Imet::$sortBy }}', '{{ \AndreaMarelli\ImetCore\Models\Imet\Imet::$sortDirection }}');
                }

            });
        </script>
    @endpush

@endsection