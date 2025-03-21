<container_section :event_name="'{{ $name }}'" :id="'{{ $name }}'" :title="'{{ $title }}'"
    :code="'{{ $code }}'" :info_label="'imet-core::analysis_report.guidance.analysis_per_element'">
    <template v-slot:default="container">
        <div class="max-w-12xl m-auto">
            <container_analysis_management_cycle id="sub_elem_1" :items="{{ json_encode($custom_names) }}"
                :title="container.props.config.element_diagrams.context[0].menu.header"
                :info_label="'imet-core::analysis_report.guidance.context.main'" :url=url :type="'context'"
                :func="'analysis_per_element_of_the_management_cycle'">
                <template v-slot:default="data">
                        @include('imet-core::scaling_up.components.analysis_element', [
                            'name' => $name,
                            'dontShowTitle' => false,
                            'sub_class' => 'sub-title-second',
                        ])
                        <container :loaded_at_once="true" :url=url
                            :title="container.props.config.element_diagrams.threats.menu.title"
                            :randomKeyEvent="data.props.randomKeyEvent" :parameters="data.props.parameters"
                            :func="'get_threats_categories_per_protected_area'">
                            <template v-slot:default="values">
                                <div v-if="Object.entries(data.props.values).length > 0">
                                <div v-if="values.props.values.length > 0">
                                    @include('imet-core::scaling_up.components.analysis_element_threat', [
                                        'name' => $name,
                                        'sub_class' => 'sub-title-second',
                                    ])
                                </div>
                                </div>
                            </template>
                        </container>
                </template>
            </container_analysis_management_cycle>
            <container_analysis_management_cycle id="sub_elem_2" :loaded_at_once="container.props.show_view"
                :info_label="'imet-core::analysis_report.guidance.planning.main'"
                :title="container.props.config.element_diagrams.planning[0].menu.header" :url=url
                :type="'planning'" :items="{{ json_encode($custom_names) }}"
                :func="'analysis_per_element_of_the_management_cycle'">
                <template v-slot:default="data">
                    @include('imet-core::scaling_up.components.analysis_element', [
                        'name' => $name,
                        'dontShowTitle' => false,
                    ])
                </template>
            </container_analysis_management_cycle>
            <container_analysis_management_cycle id="sub_elem_3"
                :info_label="'imet-core::analysis_report.guidance.inputs.main'"
                :title="container.props.config.element_diagrams.inputs[0].menu.header" :url=url :type="'inputs'"
                :items="{{ json_encode($custom_names) }}" :func="'analysis_per_element_of_the_management_cycle'">
                <template v-slot:default="data">
                    @include('imet-core::scaling_up.components.analysis_element', [
                        'name' => $name,
                        'dontShowTitle' => false,
                    ])
                </template>
            </container_analysis_management_cycle>
            <container_view id="sub_elem_4" :event_name="'sub_elem_4'"
                :info_label="'imet-core::analysis_report.guidance.process.main'" :loaded_at_once="false"
                :loaded_at_once="container.props.show_view"
                :title="container.props.config.element_diagrams.process[0].menu.header" :url=url>
                <template v-slot:default="data">
                    @include('imet-core::scaling_up.components.analysis_process_elements', [
                        'name' => $name,
                        'sub_class' => 'sub-title-second',
                    ])
                </template>
            </container_view>
            <container_analysis_management_cycle id="sub_elem_5"
                :info_label="'imet-core::analysis_report.guidance.outputs.main'"
                :title="container.props.config.element_diagrams.outputs[0].menu.header" :url=url
                :type="'outputs'" :items="{{ json_encode($custom_names) }}"
                :func="'analysis_per_element_of_the_management_cycle'">
                <template v-slot:default="data">
                    @include('imet-core::scaling_up.components.analysis_element', [
                        'name' => $name,
                        'dontShowTitle' => false,
                        'sub_class' => 'sub-title-second',
                    ])
                </template>
            </container_analysis_management_cycle>
            <container_analysis_management_cycle id="sub_elem_6"
                :info_label="'imet-core::analysis_report.guidance.outcomes.main'"
                :title="container.props.config.element_diagrams.outcomes[0].menu.header" :url=url
                :type="'outcomes'" :items="{{ json_encode($custom_names) }}"
                :func="'analysis_per_element_of_the_management_cycle'">
                <template v-slot:default="data">
                    @include('imet-core::scaling_up.components.analysis_element', [
                        'name' => $name,
                        'dontShowTitle' => false,
                        'sub_class' => 'sub-title-second',
                    ])
                </template>
            </container_analysis_management_cycle>
        </div>
    </template>
</container_section>
