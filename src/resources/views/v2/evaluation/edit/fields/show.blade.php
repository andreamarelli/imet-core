<?php

/** @var String $v_value */
/** @var String $v_id */
/** @var String $class  */
/** @var String $other [optional] */

$vue_attributes = \ModularForms\Helpers\DOM::vueAttributes($v_id, $v_value);

?>

<input type="hidden" {!! $vue_attributes !!} {!! $class !!} {!! $other !!} />
<div class="field-preview field-disabled">@{{ {!! $v_value !!} }}</div>
