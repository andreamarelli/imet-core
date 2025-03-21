<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id [optional] */
/** @var String $class [optional] */
/** @var String $rules [optional] */
/** @var String $other [optional] */
/** @var String $module_key [optional] */

$id = $id ?? '';
$class = $class ?? '';
$rules = $rules ?? '';
$other = $other ?? '';

$vue_attributes = \ModularForms\Helpers\DOM::vueAttributes($id, $v_value);
$class_attribute = \ModularForms\Helpers\DOM::addClass($class, 'field-edit');
$rules_attribute = \ModularForms\Helpers\DOM::rulesAttribute($rules);
$other_attributes = $other ?? '';

?>

@if($type === 'imet-core::selector-wdpa')
    <selector-wdpa
        {!! $vue_attributes !!}
        search-url="{{ route('imet-core::selector.pas.search') }}"
        :data-countries='@json(\ImetCore\Models\ProtectedArea::getCountries()
                ->sortBy('name_'.\ModularForms\Helpers\Locale::lower())
                ->pluck('name_'.\ModularForms\Helpers\Locale::lower(), 'iso3')
                ->toArray(), JSON_HEX_APOS)'
    ></selector-wdpa>

@elseif($type === 'imet-core::selector-wdpa_multiple')
    <selector-wdpa
        search-url="{{ route('imet-core::selector.pas.search') }}"
        label-url="{{ route('imet-core::selector.pas.labels') }}"
        :multiple=true
        {!! $vue_attributes !!}
    ></selector-wdpa>


@endif



