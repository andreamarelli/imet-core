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

$vueData['AdministrativeArea_ha'] = $vueData['AdministrativeArea_ha_full'] = formatNum($vueData['records'][0]['AdministrativeArea']);
$vueData['AdministrativeArea_km2'] = $vueData['AdministrativeArea_km2_full'] = formatNum($vueData['records'][0]['AdministrativeArea']/100);
$vueData['WDPAArea_ha'] = $vueData['WDPAArea_ha_full'] = formatNum($vueData['records'][0]['WDPAArea']);
$vueData['WDPAArea_km2'] = $vueData['WDPAArea_ha_full'] = formatNum($vueData['records'][0]['WDPAArea']/100);
$vueData['GISArea_ha'] = $vueData['GISArea_ha_full'] = formatNum($vueData['records'][0]['GISArea']);
$vueData['GISArea_km2'] = $vueData['GISArea_km2_full'] = formatNum($vueData['records'][0]['GISArea']/100);
$vueData['StrictConservationArea_ha'] = $vueData['StrictConservationArea_ha_full'] = formatNum($vueData['records'][0]['StrictConservationArea']);
$vueData['StrictConservationArea_km2'] = $vueData['StrictConservationArea_km2_full'] = formatNum($vueData['records'][0]['StrictConservationArea']/100);


?>

@foreach($definitions['fields'] as $field_index => $field)

    @component('modular-forms::module.components.field_container', [
            'name' => $field['name'],
            'label' => $field['label'] ?? '',
            'label_width' => $definitions['label_width']
        ])


        @if($field_index>2)

            @include('modular-forms::module.edit.field.vue', [
                'type' => 'hidden',
                'v_value' => 'records['.$vue_record_index.'].'.$field['name'],
                'id' => "'".$definitions['module_key']."_'+".$vue_record_index."+'_".$field['name']."'"
            ])

            @include('modular-forms::module.edit.field.vue', [
                'type' => $field['type'],
                'v_value' => $field['name'].'_ha',
                'id' =>"'".$definitions['module_key'].\AndreaMarelli\ModularForms\Helpers\ModuleKey::separator.$field['name']."_ha'"
            ])
            &nbsp;[ha]

            &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;

            @include('modular-forms::module.edit.field.vue', [
                'type' => $field['type'],
                'v_value' => $field['name'].'_km2',
                'id' =>"'".$definitions['module_key'].\AndreaMarelli\ModularForms\Helpers\ModuleKey::separator.$field['name']."_km2'"
            ])
            &nbsp;[km2]

        @else

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])
            &nbsp;[km2]

        @endif

    @endcomponent

@endforeach

@push('scripts')
    <style>
        #module_imet__oecm__context__areas .module-row__input div{
            display: inline-block;
        }
    </style>
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vueData),

            watch: {
                AdministrativeArea_ha: function(value){
                    this.convert('AdministrativeArea', 'ha', value);
                },
                AdministrativeArea_km2: function(value){
                    this.convert('AdministrativeArea', 'km2', value);
                },
                WDPAArea_ha: function(value){
                    this.convert('WDPAArea', 'ha', value);
                },
                WDPAArea_km2: function(value){
                    this.convert('WDPAArea', 'km2', value);
                },
                GISArea_ha: function(value){
                    this.convert('GISArea', 'ha', value);
                },
                GISArea_km2: function(value){
                    this.convert('GISArea', 'km2', value);
                },
                StrictConservationArea_ha: function(value){
                    this.convert('StrictConservationArea', 'ha', value);
                },
                StrictConservationArea_km2: function(value){
                    this.convert('StrictConservationArea', 'km2', value);
                }
            },

            methods: {

                convert: function (fieldName, convertFrom, value) {
                    if(convertFrom==='ha'){
                        if(parseFloat(this[fieldName+'_ha_full']).toFixed(2) !== parseFloat(value).toFixed(2)){
                            this.records[0][fieldName] = parseFloat(value);
                            this[fieldName+'_ha_full'] = this.records[0][fieldName];
                            this[fieldName+'_km2_full'] = parseFloat(this[fieldName+'_ha_full'])/100;
                            this[fieldName+'_km2'] = this[fieldName+'_km2_full'].toFixed(2);
                        }
                    } else if(convertFrom==='km2'){
                        if(parseFloat(this[fieldName+'_km2_full']).toFixed(2) !== parseFloat(value).toFixed(2)){
                            this.records[0][fieldName] = parseFloat(value)*100;
                            this[fieldName+'_ha_full'] = this.records[0][fieldName];
                            this[fieldName+'_km2_full'] = parseFloat(value);
                            this[fieldName+'_ha'] = this[fieldName+'_ha_full'].toFixed(2);
                        }
                    }
                }

            }

        });
    </script>
@endpush
