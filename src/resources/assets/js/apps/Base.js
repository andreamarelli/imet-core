import Base from "@modular-forms/js/apps/Base.js";

import imetCharts from "../templates/imet_charts.vue";
import imetScoreBar from "../templates/imet_score_bar.vue";
import imetRadar from "../templates/imet_radar.vue";
import multipleFilesUpload from "../inputs/multiple-files-upload.vue";
import scopeIcon from "../templates/scope_icon.vue";

export default class BaseImet extends Base {

    constructor(options, input_data) {

        return super(options, input_data)

            // Register components
            .component('imet_charts', imetCharts)
            .component('imet_score_bar', imetScoreBar)
            .component('imet_radar', imetRadar)
            .component('multiple-files-upload', multipleFilesUpload)
            .component('scope-icon', scopeIcon);

    }

}
