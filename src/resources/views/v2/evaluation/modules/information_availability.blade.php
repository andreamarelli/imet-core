<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

?>

@include('imet-core::components.module.edit.group_with_nothing_to_evaluate', [
    'collection' => $collection,
    'definitions' => $definitions,
    'vueData' => $vueData,
])

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vueData),

            mixins: [
                window.ImetCore.Mixins.key_elements
            ]

        });
    </script>
@endpush
