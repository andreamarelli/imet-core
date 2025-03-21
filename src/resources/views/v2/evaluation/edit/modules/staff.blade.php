<?php
/** @var Mixed $definitions */
/** @var String $group_key (optional - only for GROUP_TABLE) */

$group_key = '';

$table_id = 'table_'.$definitions['module_key'];

?>

<table id="{{ $table_id }}" class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        <th class="text-center">{{ ucfirst($definitions['fields'][0]['label'] ?? '') }}</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][1]['label'] ?? '') }}</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][2]['label'] ?? '') }}</th>
        <th class="text-center">{{ ucfirst($definitions['fields'][3]['label'] ?? '') }}</th>
    </tr>
    </thead>

    {{-- inputs --}}
    <tbody class="{{ $group_key }}" v-if="hasRecordsToEvaluate('{{ $definitions['fields'][0]['name'] }}')">

        <tr class="module-table-item" v-for="(item, index) in records">

            {{--  fields  --}}
            <td>
                @include('modular-forms::module.edit.field.vue', [
                   'type' => 'disabled',
                   'v_value' => 'records[index].Theme',
                   'id' => "'".$definitions['module_key']."_'+index+'_Theme'"
               ])
            </td>

            <td>
                @include('modular-forms::module.edit.field.vue', [
                    'type' => 'disabled',
                    'v_value' => 'records[index].StaffNumberAdequacy',
                    'id' => "'".$definitions['module_key']."_'+index+'_StaffNumberAdequacy'"
                ])
            </td>

            <td>
                @include('modular-forms::module.edit.field.module-to-vue', [
                    'definitions' => $definitions,
                    'field' => $definitions['fields'][2],
                    'vue_record_index' => 'index',
                    'group_key' => $group_key,
                    'vue_directives' => 'v-if="records[index].StaffNumberAdequacy!==null"'
                ])
            </td>

            <td>
                @include('modular-forms::module.edit.field.module-to-vue', [
                    'definitions' => $definitions,
                    'field' => $definitions['fields'][3],
                    'vue_record_index' => 'index',
                    'group_key' => $group_key
                ])
            </td>


            <td>
                {{-- group_key_field (for GROUP_TABLE)  --}}
                @if($definitions['module_type']==='GROUP_TABLE')
                    @include('modular-forms::module.edit.field.vue', [
                        'type' => 'hidden',
                        'v_value' => 'item.'.$definitions['group_key_field']
                    ])
                @endif
                {{-- record id  --}}
                @include('modular-forms::module.edit.field.vue', [
                    'type' => 'hidden',
                    'v_value' => 'item.'.$definitions['primary_key']
                ])
            </td>
        <tr>
    </tbody>

    @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 4])

</table>

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))
