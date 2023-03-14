<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */


?>

@include('modular-forms::module.edit.body', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            methods:{
                __get_index(element_id){
                    return element_id.replace(this.module_key, '').replace('Aspect', '').replaceAll('_', '');
                },
                group_label(element_id){
                    let index = this.__get_index(element_id);
                    return this.records[index]['__group_stakeholders'];
                },
                percentage_stakeholder_label(element_id){
                    let index =  this.__get_index(element_id);
                    let percentage = this.records[index]['__percentage_stakeholders'];
                    percentage = parseFloat(percentage).toFixed(2);
                    return Locale.getLabel('imet-core::oecm_evaluation.KeyElements.percentage_stakeholders', {'percentage': '<b>' + percentage + '</b>'})
                }
            }

        });
    </script>
@endpush
