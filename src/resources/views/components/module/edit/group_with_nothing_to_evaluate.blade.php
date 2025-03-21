<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

?>

@foreach($definitions['groups'] as $group_key => $group_label)
    <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>

    @include('imet-core::components.module.edit.table_with_nothing_to_evaluate', [
        'collection' => $collection,
        'definitions' => $definitions,
        'vueData' => $vueData,
        'group_key' => $group_key
    ])
    <br />
    <br />

@endforeach