import Module from "@modular-forms/js/apps/Module.js";

import scopeIcon from "@imet-core/js/templates/scope_icon.vue";

export default class ModuleImet extends Module {

    constructor(options, input_data) {

        return super(options, input_data)

            // Register components
            .component('scope-icon', scopeIcon);
    }

}
