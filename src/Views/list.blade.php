<?php
/** @var \AndreaMarelli\ImetCore\Controllers\Imet\Controller $controller */
/** @var \Illuminate\Database\Eloquent\Collection $list */
/** @var \Illuminate\Http\Request $request */
/** @var array $countries */
/** @var array $years */
/** @var boolean $show_filters */
/** @var boolean $no_filter_selected */

use AndreaMarelli\ImetCore\Models\Role;
use AndreaMarelli\ModularForms\Models\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

$can_encode = User::isAdmin(\Illuminate\Support\Facades\Auth::user()) || Role::isEncoder(\Illuminate\Support\Facades\Auth::user());
$current_route = URL::route('index');
?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::form/common.imet_short')
    ]])
@endsection


@section('content')

    @if($can_encode)

        <div class="functional_buttons">
            {{-- Import json IMETs --}}
            <a class="btn-nav rounded" href="{{ action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'import']) }}">
                {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('file-import', 'white') !!}
                @lang_u('modular-forms::common.import')
            </a>
            {{-- Export json IMETs --}}
            <a class="btn-nav rounded" href="{{ action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'export_view']) }}">
                {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('file-export', 'white') !!}
                @lang_u('modular-forms::common.export')
            </a>
            {{-- Create new IMET --}}
            @include('modular-forms::buttons.create', ['controller' => \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class, 'label' => trans('imet-core::form/common.create')])
        </div>

    @endif

    @if($show_filters)
        @include('imet-core::components.common_filters', [
            'request'=>$request,
            'url' => $current_route,
            'no_filter_selected' => $no_filter_selected,
            'countries' => $countries,
            'years' => $years
        ])
    @endif

    <div id="sortable_list">

        @if(!$show_filters || !$no_filter_selected)

            @include('modular-forms::tables.sort_on_client.num_records')

            <table class="striped">
                <thead>
                <tr>
                    <th class="text-center width60px">@lang('imet-core::common.id')</th>
                    @include('modular-forms::tables.sort_on_client.th', ['column' => 'Year', 'label' => trans('imet-core::common.year'), 'class' => 'width90px'])
                    @include('modular-forms::tables.sort_on_client.th', ['column' => 'name', 'label' => trans_choice('imet-core::common.protected_area.protected_area', 1)])
                    <th class="text-center">@lang('imet-core::form/common.encoders_responsible')</th>
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

                                {{-- name --}}
                                <div class="imet_pa_name">
                                    <strong style="font-size: 1.1em;">@{{ item.name }}</strong>
                                    (<a target="_blank" :href="'{{ \AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet::WEBSITE_URL }}'+ item.wdpa_id">@{{ item.wdpa_id }}</a>)
                                    <br />
                                    <flag :iso2=item.iso2></flag>&nbsp;&nbsp;<i>@{{ item.country_name }}</i>
                                </div>

                                <br />

                                {{-- language --}}
                                <div>
                                    @lang_u('imet-core::form/common.encoding_language'):
                                    <flag :iso2=item.language></flag>
                                </div>

                                {{-- version --}}
                                <div>
                                    @lang_u('imet-core::common.version'):
                                    <span v-if="item.version==='v2'" class="badge badge-success">v2</span>
                                    <span v-else-if="item.version==='v1'" class="badge badge-secondary">v1</span>
                                </div>

                            </div>
                        </td>

                        <td class="align-baseline">
                            <imet_encoders_responsibles
                                :items=item.encoders_responsibles
                                :labels='@json(\AndreaMarelli\ImetCore\Models\Imet\Imet::getResponsiblesLabels())'
                            ></imet_encoders_responsibles>
                        </td>
                        <td>
                            <imet_radar :width=150 :height=150 :values=item.assessment ></imet_radar>
                        </td>
                        <td class="align-baseline text-center" style="white-space: nowrap;">

                            {{-- Show --}}
                            <span v-if="item.version==='v2'">
                                @include('imet-core::components.button_show', ['version' => 'v2'])
                            </span>

                            @if($can_encode)

                                {{-- Edit --}}
                                <span v-if="item.version==='v1'">
                                    @include('imet-core::components.button_edit', ['version' => 'v1'])
                                </span>
                                <span v-else-if="item.version==='v2'">
                                    @include('imet-core::components.button_edit', ['version' => 'v2'])
                                </span>

                                {{-- Merge tool --}}
                                <span v-if="item.has_duplicates">
                                    @include('modular-forms::buttons._generic', [

                                        'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\Controller::class,
                                        'action' =>'merge_view',
                                        'item' => 'item.FormID',
                                        'tooltip' => ucfirst(trans('modular-forms::common.merge')),
                                        'icon' => 'clone',
                                        'class' => 'blue'
                                    ])
                                </span>

                            @endif

                            {{-- Export --}}
                            @include('modular-forms::buttons._generic', [
                                'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\Controller::class,
                                'action' =>'export',
                                'item' => 'item.FormID',
                                'tooltip' => ucfirst(trans('modular-forms::common.export')),
                                'icon' => 'cloud-download-alt',
                                'class' => 'blue'
                            ])

                            {{-- Print --}}
                            <span v-if="item.version==='v2'">
                                @include('modular-forms::buttons._generic', [
                                    'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class,
                                    'action' =>'print',
                                    'item' => 'item.FormID',
                                    'tooltip' => ucfirst(trans('modular-forms::common.print')),
                                    'icon' => 'print',
                                    'class' => 'blue'
                                ])
                            </span>

                            @if($can_encode)

                                {{-- Delete --}}
                                @include('modular-forms::buttons.delete', [
                                    'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\Controller::class,
                                    'item' => 'item.FormID'
                                ])


                            @endif

                        </td>
                    </tr>
                </tbody>

            </table>

        @endif

    </div>

    @push('scripts')

        <script>

            new window.ModularForms.SortableTable({
                el: '#sortable_list',
                data: {
                    list: @json($list),
                    pageSize: 10
                },

                mounted: function () {
                    this.sort('{{ AndreaMarelli\ImetCore\Models\Imet\Imet::$sortBy }}', '{{\AndreaMarelli\ImetCore\Models\Imet\Imet::$sortDirection }}');
                }

            });
        </script>
    @endpush

@endsection
