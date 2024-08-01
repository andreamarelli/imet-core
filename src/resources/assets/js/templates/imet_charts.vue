<template>

    <div class="container">

        <!-- ##### Histogram ##### -->
        <div v-if=show_histogram class="imet_histogram">
            <div class="imet_histogram__row" v-for="item in values">
                <!-- label -->
                <div class="text-left imet_histogram__label">{{ item.label }}</div>
                <!-- value -->
                <div class="text-left imet_histogram__value">
                    <b><span v-if="item.value!==null">{{ item.value }}</span></b>
                </div>
                <!-- progress bar -->
                <div class="imet_histogram__progress_bar text-2xs">
                    <progress_bar
                        :value=item.value
                        :color=item.color
                    />
                </div>
            </div>
        </div>

        <!-- ##### Radar ##### -->
        <div class="imet_radar">
            <imet_radar :values=radar_values :width=380 :height=250 ></imet_radar>
        </div>

    </div>


</template>

<style lang="scss" scoped>

    .container{
        display: flex;
        width: 100%;
        @media (min-width: 1000px) {
            flex-direction: row;
            .imet_histogram{
                flex-grow: 1;
            }
        }
        @media (max-width: 999px) {
            flex-direction: column;
            align-items: center;
            .imet_histogram{
                width: 100%;
            }
        }
        .imet_histogram{
            .imet_histogram__row{
                display: flex;
                flex-direction: row;
                flex-wrap: nowrap;
                .imet_histogram__label{
                    width: 210px;
                    padding-left: 10px;
                    padding-top: 5px;
                    padding-bottom: 5px;
                }
                .imet_histogram__value{
                    width: 40px;
                }
                .imet_histogram__progress_bar{
                    flex-grow: 1;
                }
            }
         }
        .imet_radar{
            text-align: center;
        }
    }

</style>

<script setup>

import { ref, computed, onMounted } from "vue";
import progress_bar from "./progress_bar.vue";

const props = defineProps({
    form_id: {
        type: [Number, String],
        default: null
    },
    version: {
        type: String,
        default: null
    },
    labels:{
        type: [Object],
        default: () => null
    },
    show_histogram: {
        type: Boolean,
        default: true
    },
    steps: {
        type: Array,
        default: () => {
            return ['context', 'planning', 'inputs', 'process', 'outputs', 'outcomes' ]
        }
    },
    colors: {
        type: Array,
        default: () => {
            return ['#FFFF00', '#BFBFBF', '#FFC000', '#00B0F0', '#92D050', '#00B050']
        }
    }
});

const api_data = ref(null);
const values = computed(() => {
    let _values = [];
    props.steps.forEach(function(step, index){
        _values.push({
            'label': get_label(index),
            'value': get_key_from_api(step),
            'color': props.colors[index],
        });
    });
    return _values;
});
const radar_values = computed(() => {
    let radar_values = {};
    if(values.value.length>0){
        Object.entries(values.value).forEach(function([key, value]){
            radar_values[value.label] = parseFloat(value.value).toFixed(1);
        });
    }
    return radar_values;
});

onMounted(() => {
    retrieve_api();
});

// window.vueBus.$on('refresh_assessment', function () {
//     _this.retrieve_api();
// });

function get_label(index) {
    return api_data.value!==null
        ? props.labels[props.version]['full'][index]
        : null;
}
function get_key_from_api(key) {
    return api_data.value!==null && api_data.value.hasOwnProperty(key) && api_data.value[key]!==null
        ? api_data.value[key].toFixed(1)
        : null;

}
function retrieve_api(){
    if(props.form_id!==null){
        let url = props.version === 'oecm'
          ? window.Routes.assessment_oecm
          : window.Routes.assessment;
        fetch(url.replace('__id__', props.form_id), {
            method: 'GET',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": window.Laravel.csrfToken,
            }
        })
            .then((response) => response.json())
            .then(function(data){
                api_data.value = data;
            });
    }
}




</script>
