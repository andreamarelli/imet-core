<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id */
/** @var String $class */
/** @var String $rules */
/** @var String $other */
/** @var Mixed $definitions */

?>

@include('modular-forms::module.edit.field.vue', [
    'type' => 'disabled',
    'v_value' => $v_value,
    'id' => $id,
    'class' => $class,
    'rules' => $rules,
    'other' => $other,
    'module_key' => $definitions['module_key']
])

<div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
    <div>@uclang('imet-core::oecm_evaluation.KeyElements.from_group')<b v-html="group_label({{ $id }})"></b></div>
    <div v-html="percentage_stakeholder_label({{ $id }})"></div>
</div>
