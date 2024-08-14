import Module from "@modular-forms/js/apps/Module.js";

import scopeIcon from "../templates/scope_icon.vue";
import selectorWdpa from "../inputs/selector-wdpa.vue";

export default class ModuleImet extends Module {

    constructor(input_data = {}, custom_props = {}) {

        return super(input_data, custom_props)

            // Register components
            .component('selector-wdpa', selectorWdpa)
            .component('scope-icon', scopeIcon);
    }

}
