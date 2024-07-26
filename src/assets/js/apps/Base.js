import Base from "@modular-forms/js/apps/Base.js";
import multipleFilesUpload from "@imet-core/js/inputs/multiple-files-upload.vue";

export default class BaseImet extends Base {

    constructor(options, input_data) {

        return super(options, input_data)

            // Register components
            .component('multiple-files-upload', multipleFilesUpload);

    }

}
