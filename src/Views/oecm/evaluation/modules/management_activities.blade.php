<?php
/** @var Mixed $definitions */
?>

@foreach($definitions['groups'] as $group_key => $group_label)

    <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>

    <table id="{{ 'group_table_'.$definitions['module_key'].'_'.$group_key }}" class="table module-table">

        {{-- labels  --}}
        <thead>
        <tr>
            @foreach($definitions['fields'] as $field)
                @if($field['type']!=='hidden')
                    <th class="text-center">{{ ucfirst($field['label'] ?? '') }}</th>
                @endif
            @endforeach
            <th></th>
        </tr>
        </thead>

        {{-- inputs --}}
        <tbody class="{{ $group_key }}">
        @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 4, 'attributes' => 'v-if="records[\'' . $group_key . '\'][0].' . $definitions['fields'][0]['name'] . '===null"'])
        <tr v-else class="module-table-item" v-for="(item, index) in {{ 'records[\''.$group_key.'\']' }}">
            {{--  fields  --}}
            @foreach($definitions['fields'] as $i => $field)
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

            </td>
        </tr>
        </tbody>


    </table>

    <br/>
    <br/>

@endforeach

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            methods: {
                plain_name(fullName) {
                    return fullName != null && this.isTaxonomy(fullName)
                        ? this.getScientificName(fullName)
                        : fullName;
                },

                tooltip(fullName) {
                    return fullName != null && this.isTaxonomy(fullName)
                        ? fullName.replace(/\|/g, " ")
                        : '';
                },

                isTaxonomy(fullName) {
                    return (fullName.match(/\|/g) || []).length === 5
                },

                getScientificName(fullName) {
                    let sciName = null;
                    if (fullName !== null) {
                        let taxonomy = fullName.split("|");
                        sciName = taxonomy[4] + ' ' + taxonomy[5]
                    }
                    return sciName;
                },
            }

        });
    </script>
@endpush
