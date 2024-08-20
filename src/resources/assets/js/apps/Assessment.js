import BaseImet from "./Base";

import imetScoreBar from "../templates/imet_score_bar.vue";
import imetProcessRadar from "../templates/imet_process_radar.vue";

import { createApp, ref, computed, onMounted, onBeforeMount } from "vue";

export default class Assessment {

    constructor(input_data = {}) {

        const options = {

            name: 'Assessment',

            props: {
                api_data: {
                    type: Object,
                    default: () => {}
                },
                api_labels: {
                    type: Object,
                    default: () => {}
                },
                form_id: {
                    type: [Number, String],
                    default: ''
                },
                current_step: {
                    type: String,
                    default: ''
                }
            },

            setup(props, context) {

                const Locale = window.ModularForms.Helpers.Locale;

                const step_indexes = ref(null);
                const step_indexes_intermediate = ref(null);
                const step_color = ref('#000');

                onBeforeMount(() => {
                    initProperties();
                });

                const labels = computed(() => {
                    let labels = {};
                    if (props.api_data.labels !== null) {
                        Object.entries(props.api_data.labels).forEach(function (item) {
                            labels[item[0]] = {
                                code: item[1]['code_label'],
                                title: item[1]['title_' + Locale.getLocale()],
                                min: 0,
                                max: 100
                            };
                            if (labels[item[0]].code === 'C2' || labels[item[0]].code === 'C3') {
                                labels[item[0]].min = -100;
                            }
                        });
                    }
                    return labels;
                });

                const values = computed(() => {
                    let vv = {};
                    step_indexes.value.forEach(function (index) {
                        vv[index] = get_key_from_api(index);
                    });
                    return vv;
                });

                const intermediate_values = computed(() => {
                    let intermediate_values = [];
                    if(step_indexes_intermediate.value.length > 0){
                        step_indexes_intermediate.value.forEach(index => {
                            intermediate_values[index] = get_key_from_api(index);
                        });
                    }
                    return intermediate_values;
                });

                const synthetic_indicator = computed(() => {
                    return get_key_from_api('avg_indicator');
                });

                function get_key_from_api(key){
                    return props.api_data.hasOwnProperty(key) && props.api_data[key] !== null
                        ? props.api_data[key].toFixed(1)
                        : null;
                }
                
                function initProperties(){
                    switch (props.current_step) {
                        case 'context':
                            step_indexes.value = ['c1', 'c2', 'c3'];
                            step_indexes_intermediate.value = ['c11', 'c12', 'c13', 'c14', 'c15'];
                            step_color.value = '#FFFF00';
                            break;
                        case 'planning':
                            step_indexes.value = ['p1', 'p2', 'p3', 'p4', 'p5', 'p6'];
                            step_color.value = '#BFBFBF';
                            break;
                        case 'inputs':
                            step_indexes.value = ['i1', 'i2', 'i3', 'i4', 'i5'];
                            step_color.value = '#FFC000';
                            break;
                        case 'process':
                            step_indexes.value = [
                                'pr1', 'pr2', 'pr3', 'pr4', 'pr5', 'pr6', 'pr7', 'pr8', 'pr9', 'pr10',
                                'pr11', 'pr12', 'pr13', 'pr14', 'pr15', 'pr16', 'pr17', 'pr18'
                            ];
                            step_indexes_intermediate.value = ['pr1_6', 'pr7_9', 'pr10_12', 'pr13_14', 'pr15_16', 'pr17_18'];
                            step_color.value = '#00B0F0';
                            break;
                        case 'outputs':
                            step_indexes.value = ['op1', 'op2', 'op3', 'op4'];
                            step_color.value = '#92D050';
                            break;
                        case 'outcomes':
                            step_indexes.value = ['oc1', 'oc2', 'oc3'];
                            step_color.value = '#00B050';
                            break;
                    }
                }

                return {
                    values,
                    intermediate_values,
                    labels,
                    synthetic_indicator,
                    step_color
                }
            }
        };

        return createApp(options, input_data)

            .component('imet_score_bar', imetScoreBar)
            .component('imet_process_radar', imetProcessRadar);
    }

}
