<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$vue_record_index = '0';

if (!function_exists('formatNum')) {
    function formatNum($value){
        return str_replace('.', ',', $value);
    }
}

//$vueData['AdministrativeArea_ha'] = $vueData['AdministrativeArea_ha_full'] = formatNum($vueData['records'][0]['AdministrativeArea']);
//$vueData['AdministrativeArea_km2'] = $vueData['AdministrativeArea_km2_full'] = formatNum($vueData['records'][0]['AdministrativeArea']/100);
//$vueData['WDPAArea_ha'] = $vueData['WDPAArea_ha_full'] = formatNum($vueData['records'][0]['WDPAArea']);
//$vueData['WDPAArea_km2'] = $vueData['WDPAArea_ha_full'] = formatNum($vueData['records'][0]['WDPAArea']/100);
//$vueData['GISArea_ha'] = $vueData['GISArea_ha_full'] = formatNum($vueData['records'][0]['GISArea']);
//$vueData['GISArea_km2'] = $vueData['GISArea_km2_full'] = formatNum($vueData['records'][0]['GISArea']/100);

//$vueData['AdministrativeArea_km2'] = formatNum($vueData['records'][0]['AdministrativeArea']/100);
//$vueData['WDPAArea_km2'] = formatNum($vueData['records'][0]['WDPAArea']/100);
//$vueData['GISArea_km2'] = formatNum($vueData['records'][0]['GISArea']/100);


?>

@foreach($definitions['fields'] as $field_index => $field)

    @component('modular-forms::module.components.field_container', [
            'name' => $field['name'],
            'label' => $field['label'] ?? '',
            'label_width' => $definitions['label_width']
        ])


        @if(in_array($field_index, [0, 1, 2]))

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index,
                'vue_directives' => '@input=convertToKm("' . $field['name'] . '")'
            ])
{{--            --}}
{{--            @include('modular-forms::module.edit.field.vue', [--}}
{{--                'type' => 'hidden',--}}
{{--                'v_value' => 'records['.$vue_record_index.'].'.$field['name'],--}}
{{--                'id' => "'".$definitions['module_key']."_'+".$vue_record_index."+'_".$field['name']."'"--}}
{{--            ])--}}

{{--            @include('modular-forms::module.edit.field.vue', [--}}
{{--                'type' => $field['type'],--}}
{{--                'v_value' => $field['name'].'_ha',--}}
{{--                'id' =>"'".$definitions['module_key'].\AndreaMarelli\ModularForms\Helpers\ModuleKey::separator.$field['name']."_ha'"--}}
{{--            ])--}}
            <span class="ml-2 mr-4">[ha]</span>

            @include('modular-forms::module.edit.field.vue', [
                'type' => $field['type'],
                'v_value' => $field['name'].'_km2',
                'id' =>"'".$definitions['module_key'].\AndreaMarelli\ModularForms\Helpers\ModuleKey::separator.$field['name']."_km2'",
                'other' => '@input=convertToHa("' . $field['name'] . '")'
            ])
            <span class="ml-2">[km2]</span>

        @elseif($field_index===3)

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index,
                'vue_directives' => 'v-on:change="calculateShapeIndex()"'
            ])
            &nbsp;[km]

        @elseif($field_index===4 || $field_index===5)

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])
            &nbsp;[km2]

        @elseif($field_index<10)

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])
            &nbsp;%

        @elseif($field_index===10)

            @include('modular-forms::module.edit.field.vue', [
                'type' => 'disabled',
                'v_value' => 'records['.$vue_record_index.'].'.$field['name'],
                'id' => "'".$definitions['module_key']."_'+".$vue_record_index."+'_".$field['name']."'",
                'other' => 'style="max-width: 180px;"'
            ])

        @endif

    @endcomponent

@endforeach

@push('scripts')
    <style>
        #module_imet__v2__context__areas .module-row__input div{
            display: inline-block;
        }
    </style>

    <script type="module">
        window.imet__v2__context__areas = (new window.ImetCore.Apps.Modules.ImetV2.Areas(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
