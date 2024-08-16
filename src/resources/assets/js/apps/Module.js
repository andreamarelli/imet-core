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

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const Locale = window.ModularForms.Helpers.Locale;

        function hasRecordsToToEvaluate(criteria_field){
            return setup_obj.records.length !== 0 && setup_obj.records[0][criteria_field]!==null;
        }

        function key_element_label(value) {
            if (value !== null) {
                if (isTaxonomy(value)) {
                    return getScientificName(value);
                } else if (isHabitat(value)) {
                    return getHabitatLabel(value);
                }
            }
            return value;
        }

        function isTaxonomy(value) {
            return (value.match(/\|/g) || []).length === 5
        }

        function getScientificName(value) {
            let taxonomy = value.split("|");
            return taxonomy[4] + ' ' + taxonomy[5]
        }

        function isHabitat(value) {
            return !Locale.getLabel('imet-core::v2_lists.Habitats.' + value).includes('::v2_lists')
        }

        function getHabitatLabel(value) {
            return Locale.getLabel('imet-core::v2_lists.Habitats.' + value)
        }

        return {
            ...setup_obj,
            key_element_label,
            hasRecordsToToEvaluate
        };
    }

}
