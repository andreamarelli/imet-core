<container_section
    :title="'{{$title}}'"
    :id="'{{$name}}'"
    :code="'{{$code}}'"
    :guidance="'imet-core::analysis_report.guidance.comments'">
    <template slot-scope="container">
        <div class="row" id="{{$name}}-image">
            <div class="col">
                <checkboxes_list :items="{{json_encode($custom_names)}}" :minimum_valid_items="0">
                    <template slot-scope="pas">
                        <div class="align-items-center">
                            <container
                                :loaded_at_once="pas.props.show_view"
                                :url=url
                                :parameters="pas.props.ids"
                                :func="'get_comments'">
                                <template slot-scope="data">
                                    <div :id="'{{$name}}'">
                                        <container_actions :data="data.props" :name="'{{$name}}-image'"
                                                           :event_image="'save_entire_block_as_image'"
                                                           :exclude_elements="'{{$exclude_elements}}'">
                                            <template slot-scope="values">
                                                <comments
                                                    :values="values.props.values"
                                                ></comments>
                                            </template>
                                        </container_actions>
                                    </div>
                                </template>
                            </container>
                        </div>
                    </template>
                </checkboxes_list>
            </div>
        </div>
    </template>
</container_section>
