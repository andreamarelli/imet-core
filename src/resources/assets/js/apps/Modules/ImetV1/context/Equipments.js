import ModuleImet from "../../../Module.js";

import { ref, computed } from "vue";

export default class Equipments extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const averages = computed(() => {
            let averages = [];
            Object.keys(props.groups).forEach(function(group){
                averages[group] = setup_obj.calculateAverage('AdequacyLevel', group);
            });
            return averages;
        });

        return {
            ...setup_obj,
            averages
        };

    }

}