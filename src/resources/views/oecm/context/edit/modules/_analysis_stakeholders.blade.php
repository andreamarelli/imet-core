<?php

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */
/** @var Array $stakeholders */

$num_cols = count($definitions['fields']);
$user_mode = ('AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\\'.$definitions['module_class'])::$USER_MODE;
$stakeholders_categories = Stakeholders::getStakeholders(
    $vueData['form_id'],
    $user_mode,
    true
);


?>

@if(empty($stakeholders))
    @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 6])
@else

    <x-modular-forms::accordion.container>

        @foreach(array_keys($stakeholders) as $index => $stakeholder)
            <x-modular-forms::accordion.item>

                <x-slot:title>
                    <div class="w-full	h-full"
                         @click="switchStakeholder('{{ Str::replace("'", "\'", $stakeholder) }}')">
                        {{ $index + 1 }} -
                        {{ $stakeholder }}
                    </div>
                </x-slot:title>

                <div v-if="isCurrentStakeholder('{{ Str::replace("'", "\'", $stakeholder) }}')">

                    @php
                        $categories = array_key_exists($stakeholder, $stakeholders_categories)
                            ? json_decode($stakeholders_categories[$stakeholder])
                            : [];
                        $categories = $categories!==null ? $categories : [];
                    @endphp

                    @if($categories === [])
                        @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 6])

                    @else

                        {{-- groups --}}
                        @foreach($definitions['groups'] as $group_key => $group_label)

                            @php
                                $table_id = 'group_table_'.$definitions['module_key'].'_'.$group_key;
                            @endphp

                            @if(
                                in_array('provisioning', $categories) && in_array($group_key, ['group0', 'group1', 'group2', 'group3']) ||
                                in_array('cultural', $categories) && in_array($group_key, ['group4', 'group5', 'group6' ]) ||
                                in_array('regulating', $categories) && in_array($group_key, ['group7', 'group8']) ||
                                in_array('supporting', $categories) && in_array($group_key, ['group9', 'group10'])
                            )

                                {{-- titles --}}
                                @if($group_key === 'group0')
                                    <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title0')</h4>
                                @elseif($group_key === 'group4')
                                    <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title1')</h4>
                                @elseif($group_key === 'group7')
                                    <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title2')</h4>
                                @elseif($group_key === 'group9')
                                    <h4 style="margin-bottom: 20px;">@lang('imet-core::oecm_context.AnalysisStakeholders.titles.title3')</h4>
                                @endif

                                {{-- sub-titles --}}
                                <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>

                                {{-- Desctiptions --}}
                                <div class="pb-4 px-6 text-sm">
                                    @lang('imet-core::oecm_context.AnalysisStakeholders.groups_descriptions.' . $group_key)
                                </div>

                                <table id="{{ $table_id }}" class="table module-table">

                                    {{-- labels  --}}
                                    <thead>
                                    <tr>
                                        @foreach($definitions['fields'] as $index => $field)
                                            <th class="text-center">
                                                @if($field['type']!=='hidden')
                                                    {{ ucfirst($field['label'] ?? '') }}
                                                @endif
                                            </th>
                                        @endforeach
                                        <th></th>
                                    </tr>
                                    </thead>

                                    {{-- records --}}
                                    <tbody class="{{ $group_key }}">

                                        <template v-for="(item, index) in records">
                                            <tr class="module-table-item"
                                                    v-if="recordIsInGroup(item, '{{ $group_key }}') && isCurrentStakeholder(item['Stakeholder'])">
                                                {{--  fields  --}}
                                                @foreach($definitions['fields'] as $index => $field)
                                                    <td>
                                                        @include('modular-forms::module.edit.field.module-to-vue', [
                                                           'definitions' => $definitions,
                                                           'field' => $field,
                                                           'vue_record_index' => 'index',
                                                           'group_key' => $group_key
                                                       ])
                                                    </td>
                                                @endforeach
                                                <td>
                                                    {{-- record id  --}}
                                                    @include('modular-forms::module.edit.field.vue', [
                                                        'type' => 'hidden',
                                                        'v_value' => 'item.'.$definitions['primary_key']
                                                    ])
                                                    <span v-if="typeof item.__predefined === 'undefined'">
                                                        <x-modular-forms::module.components.buttons.delete-item />
                                                    </span>
                                                </td>
                                            </tr>
                                        </template>

                                    </tbody>

                                    {{-- add button --}}
                                    <tfoot v-if="numItemPerGroupAndStakeholder('{{ $group_key }}', '{{ $stakeholder }}') < {{ $definitions['max_rows'] }}">
                                    <tr>
                                        <td colspan="{{ count($definitions['fields']) + 1 }}">
                                            @include('modular-forms::buttons.add_item', [
                                                'onClick' => "addItem('". $group_key . "', '". Str::replace("'", "\'", $stakeholder)  . "')"
                                            ])
                                        </td>
                                    </tr>
                                    </tfoot>

                                </table>


                                <br/>
                                <br/>
                            @endif
                        @endforeach

                    @endif

                </div>

            </x-modular-forms::accordion.item>
        @endforeach

    </x-modular-forms::accordion.container>

@endif

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vueData),

            methods: {

                isCurrentStakeholder(value) {
                    return this.current_stakeholder === value;
                },

                switchStakeholder(value) {
                    if (!this.isCurrentStakeholder(value)) {
                        this.current_stakeholder = value;
                    } else {
                        this.current_stakeholder = null;
                    }
                    this.resetModule();
                },

                showAddButton(group_key, stakeholder){
                    let count = 0;
                    this.records[group_key].forEach(function (item, index) {
                        if (item['Stakeholder'] === stakeholder){
                            count++;
                        }
                    });
                },

                numItemPerGroupAndStakeholder: function (group_key, stakeholder) {
                    let count = 0;
                    this.records[group_key].forEach(function (item, index) {
                        if (item['Stakeholder'] === stakeholder){
                            count++;
                        }
                    });
                    return count;
                },

                addItem: function (group_key, stakeholder) {
                    this.records[group_key].push(this.__no_reactive_copy(this.empty_record));
                    this.records[group_key][this.records[group_key].length - 1][this.group_key_field] = group_key;
                    this.records[group_key][this.records[group_key].length - 1]['Stakeholder'] = stakeholder;
                },

                deleteItem: function (event) {
                    let _this = this;

                    let table_row_index = event.currentTarget.closest('tr').rowIndex - 1; // force to start at 0
                    let group_key = event.currentTarget.closest('table').id.replace('group_table_' + this.module_key + '_', '');

                    let same_stakeholder_count = 0;
                    this.records[group_key].forEach(function (item, index) {

                        if (item['Stakeholder'] === _this.current_stakeholder && group_key === item['group_key']) {
                            if (same_stakeholder_count === table_row_index) {
                                _this.records[group_key].splice(index, 1);
                            }
                            same_stakeholder_count++;
                        }
                    });

                },

                saveModuleDoneCallback(data) {
                    this.current_stakeholder = null;
                    window.ModularForms.Mixins.Animation.scrollPageToAnchor('module_{{ $definitions['module_key'] }}');
                    module_analysis_stakeholder_summary.refresh_importances(data.key_elements_importance);
                },

            }

        });
    </script>
@endpush