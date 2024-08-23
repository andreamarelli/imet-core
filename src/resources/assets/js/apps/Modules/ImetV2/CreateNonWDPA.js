import ModuleImet from "../../Module.js";

export default class CreateNonWDPA extends ModuleImet {

    // TODO: window.ImetCore.Mixins.load_from_previous

    constructor(input_data = {}) {

        const custom_props = {
            previous_url: {
                type: String,
                default: null
            },
            show_language: {
                type: Boolean,
                default: false
            }

        };

        return super(input_data, custom_props);
    }

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        return {
            ...setup_obj
        };

    }

}