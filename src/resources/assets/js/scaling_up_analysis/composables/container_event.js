import {ref} from "vue";

export function useEvent(component_data){
    const event_name = component_data.event_name || '';
    const emitter = component_data.emitter || null;

    function load_event(data){
        if (event_name) {
            emitter.on(event_name, () => {
                data.show_view.value = true;
            });
        }
    }

    return {load_event}
}
