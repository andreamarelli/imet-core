import BaseImet from "./Base";

import { createApp } from "vue";
import imetScores from "../templates/imet_scores.vue";

export default class AssessmentScores {

    constructor(input_data = {}) {

        const options = {
            name: 'AssessmentScores',
        }

        return createApp(options, input_data)
            .component('imet_scores', imetScores);
    }
}