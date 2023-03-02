<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderAccessGovernance;
use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\StakeholdersNaturalResources;
use \Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

$stakeholders = StakeholdersNaturalResources::getStakeholders($vue_data['form_id']);

$vue_data['current_stakeholder'] = null;
$num_cols = count($definitions['fields']);

//dd($collection, $vue_data, $stakeholders);


//$original_definitions = $definitions;
//
//// First 3 groups: force "fixed_rows" and "Element" type as disabled
//$definitions['groups'] = array_slice($definitions['groups'], 0, 3);
//$definitions['fixed_rows'] = true;
//$definitions['fields'][0]['type'] = 'disabled';
//$first_groups = View::make('imet-core::components.module.edit.group_with_nothing_to_evaluate', compact(['collection', 'vue_data', 'definitions']))->render();
//
//// Other groups: normal
//$definitions = $original_definitions;
//$definitions['groups'] = array_slice($definitions['groups'], 3);
//$other_groups = View::make('imet-core::components.module.edit.group_with_nothing_to_evaluate', compact(['collection', 'vue_data', 'definitions']))->render();
//
//// Inject titles
//$dom = HtmlPageCrawler::create('<div>'.$first_groups.$other_groups.'</div>');
//$dom->filter('h5.group_title_'.$definitions['module_key'].'_group0')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title0'].'</h3>');
//$dom->filter('h5.group_title_'.$definitions['module_key'].'_group3')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title1'].'</h3>');
//$dom->filter('h5.group_title_'.$definitions['module_key'].'_group7')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title2'].'</h3>');
//$dom->filter('h5.group_title_'.$definitions['module_key'].'_group10')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title3'].'</h3>');
//$dom->filter('h5.group_title_'.$definitions['module_key'].'_group12')->before('<h3 style="margin-bottom: 20px;">'.(new AnalysisStakeholderAccessGovernance())->titles['title4'].'</h3>');

?>

{{-- Stakeholder selector--}}
<button class="btn-nav mb-1"
    v-on:click.prevent="current_stakeholder=null"
    :class="[isCurrentStakeholder(null) ? 'dark' : 'basic']"
>SUMMARY</button>
@foreach($stakeholders as $stakeholder)
    <button class="btn-nav mb-1"
        v-on:click.prevent="current_stakeholder='{{ $stakeholder }}'"
        :class="[isCurrentStakeholder('{{ $stakeholder }}') ? 'dark' : 'basic']"
    >{{ $stakeholder }}</button>
@endforeach

{{-- Stakeholder's form--}}
<p  v-if="isCurrentStakeholder(null)" > summary </p>
@foreach($stakeholders as $stakeholder)
    <div v-if="isCurrentStakeholder('{{ $stakeholder }}') ">

        {{-- groups --}}
        @foreach($definitions['groups'] as $group_key => $group_label)
            <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>

            @php
                $table_id = 'group_table_'.$definitions['module_key'].'_'.$group_key;
                $tr_record = 'records[\''.$group_key.'\']';
//            @endphp

            <table id="{{ $table_id }}" class="table module-table">

                {{-- labels  --}}
                <thead>
                <tr>
                    @foreach($definitions['fields'] as $field)
                        <th class="text-center">
                            @if($field['type']!=='hidden')
                                {{ ucfirst($field['label'] ?? '') }}
                            @endif
                        </th>
                    @endforeach
                    <th></th>
                </tr>
                </thead>

                {{-- noting to evaluate --}}
                <tbody class="{{ $group_key }}" v-if="records['{{ $group_key }}'][0].{{ $definitions['fields'][0]['name'] }}===null">
                    @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => $num_cols])
                </tbody>

                {{-- records --}}
                <tbody class="{{ $group_key }}" v-else>

                    <tr class="module-table-item" v-for="(item, index) in {{ $tr_record }}" v-if="isCurrentStakeholder(item['Stakeholder'])">
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
                            @if(!$definitions['fixed_rows'])
                                <span v-if="typeof item.__predefined === 'undefined'">
                                    @include('modular-forms::buttons.delete_item')
                                </span>
                            @endif
                        </td>
                    </tr>

                </tbody>

            </table>

            <br />
            <br />
        @endforeach

    </div>
@endforeach



@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            methods: {

                isCurrentStakeholder(value){
                    return this.current_stakeholder === value;
                }

            }

        });
    </script>
@endpush