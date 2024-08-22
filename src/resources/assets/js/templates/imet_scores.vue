<template>

    <!-- ##### GLOBAL ##### -->
    <div class="flex w-full flex-row items-center">
        <!-- histogram -->
        <div class="grow">
            <div v-for="(step_props, step_key) in properties">
                <imet_score_row
                    :label="labels[step_key]"
                    :value="api_data['scores'][step_key].avg_indicator"
                    :color=step_props.color
                ></imet_score_row>
            </div>
        </div>
        <!-- radar -->
        <imet_radar :values=radar_values :width=380 :height=250></imet_radar>
    </div>

    <!-- ##### STEPS ##### -->
    <template v-for="(step_props, step_key) in properties">

        <div class="mb-10" v-if="current_step===step_key || current_step==='management_effectiveness'">

            <!-- Title + synthetic score-->
            <imet_score_row
                :label="labels[step_key]"
                :value="api_data['scores'][step_key].avg_indicator"
                :color=step_props.color
                :is-header=true
            ></imet_score_row>

            <!-- Scores-->
            <div v-for="(index, idx) in step_props.indexes">
                <imet_score_row
                    :label="labels[index]['title_fr']"
                    :code="labels[index]['code_label']"
                    :value="api_data['scores'][step_key][index]"
                    :histogram_type="histogram_type(step_key, idx)"
                    :color=step_props.color
                ></imet_score_row>
            </div>

            <!-- custom additional scores -->
            <div class="mt-4" v-if="step_key==='context'">
                <template v-for="ctx_key in ['c11', 'c12', 'c13', 'c14', 'c15']">
                    <imet_score_row
                        :label="labels[ctx_key]['title_fr']"
                        :code="labels[ctx_key]['code_label']"
                        :value="api_data['scores']['context'][ctx_key]"
                        histogram_type="0_to_100"
                        :color=step_props.color
                    ></imet_score_row>
                </template>
            </div>
            <div class="mt-4" v-else-if="step_key==='process'">
                <imet_process_radar
                    :values="[
                        api_data['scores']['process']['pr1_6'],
                        api_data['scores']['process']['pr7_9'],
                        api_data['scores']['process']['pr10_12'],
                        api_data['scores']['process']['pr13_14'],
                        api_data['scores']['process']['pr15_16'],
                        api_data['scores']['process']['pr17_18']
                    ]"
                    :labels="[
                        labels['pr1_6']['title_fr'],
                        labels['pr7_9']['title_fr'],
                        labels['pr10_12']['title_fr'],
                        labels['pr13_14']['title_fr'],
                        labels['pr15_16']['title_fr'],
                        labels['pr17_18']['title_fr']
                    ]"
                ></imet_process_radar>
            </div>

        </div>

    </template>

</template>

<script setup>

import { computed } from "vue";
import { storeToRefs } from "~/pinia";
import imet_score_row from "./imet_score_row.vue";
import imet_process_radar from "./imet_process_radar.vue";
import imet_radar from "./imet_radar.vue";

const props = defineProps({
    current_step: {
        type: String,
        default: null
    },
    labels: {
        type: Object,
        default: () => {}
    },
    store: null
});

const { api_data } = storeToRefs(props.store);

const properties = {
    'context': {
        'indexes': ['c1', 'c2', 'c3'],
        'histogram_types': ['0_to_100', 'minus100_to_100', 'minus100_to_0'],
        'color': '#FFFF00',
    },
    'planning': {
        'indexes': ['p1', 'p2', 'p3', 'p4', 'p5', 'p6'],
        'color': '#BFBFBF',
    },
    'inputs': {
        'indexes': ['i1', 'i2', 'i3', 'i4', 'i5'],
        'color': '#FFC000'
    },
    'process': {
        'indexes': [
            'pr1', 'pr2', 'pr3', 'pr4', 'pr5', 'pr6', 'pr7', 'pr8', 'pr9', 'pr10',
            'pr11', 'pr12', 'pr13', 'pr14', 'pr15', 'pr16', 'pr17', 'pr18'
        ],
        'intermediate_indexes': ['pr1_6', 'pr7_9', 'pr10_12', 'pr13_14', 'pr15_16', 'pr17_18'],
        'color': '#00B0F0'
    },
    'outputs': {
        'indexes': ['op1', 'op2', 'op3', 'op4'],
        'color': '#92D050'
    },
    'outcomes': {
        'indexes': ['oc1', 'oc2', 'oc3'],
        'histogram_types': ['0_to_100', 'minus100_to_0', 'minus100_to_0'],
        'color': '#00B050'
    },
};

const radar_values = computed(() => {
    let radar_values = {};
    if(props.api_data){
        Object.keys(properties).forEach(function(step){
            let label = props.labels[step];
            radar_values[label] = props.api_data['scores'][step].avg_indicator;
        });
    }
    return radar_values;
});


function histogram_type(step_key, idx){
    return properties[step_key].hasOwnProperty('histogram_types')
        ? properties[step_key].histogram_types[idx]
        : '0_to_100_full_width';
}


</script>