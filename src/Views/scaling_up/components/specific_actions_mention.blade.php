<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <container_actions :data="{}" :name="'{{$name}}'"
                            :event_image="'save_entire_block_as_image'"
                            :exclude_elements="'{{$exclude_elements}}'">
            <template slot-scope="data">
                <div class="row">
                    <div class="col-sm">
                        <div class="align-items-center">
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5>@lang('imet-core::form/imet/analysis_report/report.governance_management')</h5>
                                    <editor></editor>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5>@lang('imet-core::form/imet/analysis_report/report.key_conservation_elements')</h5>
                                    <editor></editor>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5>@lang('imet-core::form/imet/analysis_report/report.climate_change_ecosystem')</h5>
                                    <editor></editor>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <h5>@lang('imet-core::form/imet/v2/common.steps.threats')</h5>
                                    <editor></editor>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </container_actions>
    </template>
</container_section>