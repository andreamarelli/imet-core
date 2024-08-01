import Module from "@modular-forms/js/apps/Module.js";

import scopeIcon from "../templates/scope_icon.vue";
import selectorWdpa from "../inputs/selector-wdpa.vue";

export default class ModuleImet extends Module {

    constructor(options, input_data) {

        return super(options, input_data)

            // Register components
            .component('selector-wdpa', selectorWdpa)
            .component('scope-icon', scopeIcon);
    }

}
