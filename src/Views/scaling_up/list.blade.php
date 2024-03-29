<?php
/** @var \AndreaMarelli\ImetCore\Controllers\Imet\Controller $controller */
/** @var \Illuminate\Database\Eloquent\Collection $list */
/** @var \Illuminate\Http\Request $request */
/** @var array $countries */
/** @var array $years */

/** @var boolean $filter_selected */

use \AndreaMarelli\ImetCore\Models\Imet\Imet;
use Illuminate\Support\Facades\URL;

$url = URL::route('imet-core::scaling_up_index');
?>

@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')

    <h1>@lang('imet-core::analysis_report.scaling_up')</h1>

    @include('imet-core::components.common_filters', [
        'request'=>$request,
        'url' => $url,
        'filter_selected' => $filter_selected,
        'countries' => $countries,
        'years' => $years
    ])

    <br/>
    <div id="sortable_list">
        <div id="cloud">
            <label-cloud
                :cookie-name="'analysis'"
                url="{{ route('imet-core::scaling_up_report', ['items' => "__items__"]) }}"
                :label-scaling-up="'Scaling up analysis'"
                :label-remove-all="'@lang('imet-core::analysis_report.remove_all')'"
                :source-of-data="'cookie'"></label-cloud>
        </div>

        <action-button-cookie
            :class-name="'btn btn-success'"
            :cookie-name="'analysis'"
            :event="'update_cloud_tags'"
            :label="'@lang('imet-core::analysis_report.add_choices')'">
        </action-button-cookie>

        <button class="btn btn-success" @click="add_all()">@lang('imet-core::analysis_report.add_all')</button>
        <br/>
        <br/>

        @include('modular-forms::tables.sort_on_client.num_records')

        <table class="striped">
            <thead>
            <tr>
                <th class="text-center width30px">
                    <input type='checkbox'
                           class="ml-1 vue-checkboxes"
                           @click="check_all()"
                           v-model="are_checked_all">
                </th>
                <th class="text-center width60px">@lang('imet-core::common.id')</th>
                @include('modular-forms::tables.sort_on_client.th', ['column' => 'Year', 'label' => trans('imet-core::common.year'), 'class' => 'width90px'])
                @include('modular-forms::tables.sort_on_client.th', ['column' => 'name', 'label' => trans_choice('imet-core::common.protected_area.protected_area', 1)])
                <th class="text-center">@lang('imet-core::common.encoders_responsible')</th>
                <th>{{-- radar --}}</th>
                <th class="width200px">{{-- actions --}}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item of items">
                <td class="align-baseline text-center">
                    <input type="checkbox"
                           :checked="is_checked(item.FormID)"
                           :data-name="item.name"
                           @click="selectValueByIdAndValue(item.FormID, item.name)"
                           class="vue-checkboxes"
                           :value="item.FormID">
                </td>
                <td class="align-baseline text-center">#@{{ item.FormID }}</td>
                <td class="align-baseline text-center"><strong>@{{ item.Year }}</strong></td>
                <td class="align-baseline">

                    <div class="imet_name">
                        <div class="imet_pa_name">
                            {{-- name --}}
                            <strong style="font-size: 1.1em;">@{{ item.name }}</strong>
                            {{-- wdpa_id --}}
                            <span v-if="item.wdpa_id!==null">
                                (<a target="_blank"
                                    :href="'{{ \AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet::WEBSITE_URL }}'+ item.wdpa_id">@{{ item.wdpa_id }}</a>)
                            </span>
                            <br/>
                            {{-- country --}}
                            <flag :iso2=item.country.iso2></flag>&nbsp;&nbsp;<i>@{{ item.country.name }}</i>
                        </div>
                        <br/>
                        {{-- language --}}
                        <div>
                            {{ ucfirst(trans('imet-core::common.encoding_language')) }}:
                            <flag :iso2=item.language></flag>
                        </div>
                        {{-- version --}}
                        <div>
                            {{ ucfirst(trans('imet-core::common.version')) }}:
                            <span v-if="item.version==='{{ Imet::IMET_V2 }}'" class="badge badge-success">v2</span>
                            <span v-else-if="item.version==='{{ Imet::IMET_V1 }}'" class="badge badge-secondary">v1</span>
                        </div>
                    </div>
                </td>
                <td class="align-baseline">
                    <imet_encoders_responsibles
                        :items=item.encoders_responsibles
                    ></imet_encoders_responsibles>
                </td>
                <td>
                    <imet_radar
                        style="margin: 0 auto;"
                        :width=150 :height=150
                        :values=item.assessment_radar
                        v-if="!Object.values(item.assessment_radar).every(elem => elem === null)"
                    ></imet_radar>
                </td>
                <td class="align-baseline text-center" style="white-space: nowrap;">

                    {{-- Show --}}
                    <span v-if="item.version==='{{ Imet::IMET_V1 }}'">
                        @include('imet-core::components.buttons.show', ['version' => Imet::IMET_V1])
                    </span>
                    <span v-else-if="item.version==='{{ Imet::IMET_V2 }}'">
                        @include('imet-core::components.buttons.show', ['version' => Imet::IMET_V2])
                    </span>

                    @can('edit', \AndreaMarelli\ImetCore\Models\Imet\Imet::class)

                        {{-- Edit --}}
                        <span v-if="item.version==='{{ Imet::IMET_V1 }}'">
                            @include('imet-core::components.buttons.edit', ['version' => Imet::IMET_V1])
                        </span>
                        <span v-else-if="item.version==='{{ Imet::IMET_V2 }}'">
                            @include('imet-core::components.buttons.edit', ['version' => Imet::IMET_V2])
                        </span>

                    @endif

                </td>
            </tr>
            </tbody>

        </table>

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
                    this.sort('{{ \AndreaMarelli\ImetCore\Models\Imet\Imet::$sortBy }}', '{{ \AndreaMarelli\ImetCore\Models\Imet\Imet::$sortDirection }}');
                },
                methods: {
                    add_all() {
                        this.list.forEach(function (item) {
                            this.selectValueByIdAndValue(item.FormID, item.name);
                        }, this);

                        this.$root.$emit('store_cookie_and_value', 'analysis', JSON.stringify(this.checkboxes));
                        this.$root.$emit('add_cloud_tags');
                    }
                }

            });
        </script>
    @endpush

@endsection
