<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$labels = trans('imet-core::v1_context.ClimateChangeImportanceElements.Element');
foreach ($vueData['records'] as $index=>$record){
    if(in_array($index, $labels)){
        $vueData['records'][$index]['Element'] = $labels[$index];
    }
}

?>

@include('modular-forms::module.edit.body', compact(['collection', 'vueData', 'definitions']))

@push('scripts')
<script>
    // ## Initialize Module controller ##
    let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
        el: '#module_{{ $definitions['module_key'] }}',
        data: @json($vueData),

        mounted: function () {
            let field = 'Element';
            let input = $(this.container).find("[id$=_"+field+"]");
            input.attr('readonly', 'readonly');
            input.addClass('field-disabled');
        }

    });
</script>
@endpush
