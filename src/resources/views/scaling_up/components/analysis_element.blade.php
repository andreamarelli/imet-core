<div class="max-w-full m-auto" v-for="(value, index) in data.props" :id="'{{$name}}-'+index">

    <div v-for="(section_data, section) in value" :id="'{{$name}}-'+section">

        <div v-for="(tableValue, tableIndex) in container.props.config.element_diagrams[section]">
            <div v-if="tableValue['menu']['radar'] !== ''">

                <?php if (!$dontShowTitle) { ?>
                <div v-if="tableValue['menu']['title']" :id="'menu-title-'+section+'-'+tableValue['name']"
                     class="horizontal">

                    <div class="sub-title" v-html="tableValue['menu']['title']"></div>
                </div> <?php } else { ?>

                    <?php
                } ?>
                <div>
                    <guidance :text="'imet-core::analysis_report.guidance.context.'+tableValue['key']"></guidance>
                </div>
            </div>
            <div class=" horizontal mt-1">
                <div class="sub-title {{ $sub_class ?? '' }}" :id="'menu-ranking-'+section+'-'+tableValue['name']">
                    <span v-html="tableValue['menu']['ranking']"></span>
                    <button class="btn-nav small blue ml-1">
                        <span class="fas fa-fw fa-info-circle"></span>
                    </button>
                    <tooltip>
                        {{ trans('imet-core::analysis_report.guidance.info.ranking') }}}
                    </tooltip>
                </div>
            </div>
            <div :id="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'category-stack'">
                <container_actions :data="section_data"
                                   :name="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'category-stack'"
                                   :event_image="'save_entire_block_as_image'">
                    <template v-slot:default="data_elements">
                        <bar_category_stack
                            :axis_dimensions_y="{max:100}"
                            :title="tableValue['menu']['ranking']"
                            :show_y_axis="true"
                            :show_option_label="tableValue['ranking_labels']"
                            :x_axis_data="data_elements.props[tableValue['name']].ranking.xAxis"
                            :legends="data_elements.props[tableValue['name']].ranking.legends"
                            :colors="container.props.config.color_correct_order"
                            :values="data_elements.props[tableValue['name']].ranking.values"
                            :percent_values="data_elements.props[tableValue['name']].ranking.percent_value"
                            :raw_values="data_elements.props[tableValue['name']].ranking.raw_values_protected_area"></bar_category_stack>
                        <div style="font-size: 12px">

                            {{ trans("imet-core::analysis_report.ranking_info_indicators") }}
                        </div>
                        <div style="font-size: 12px;" v-if="tableValue['key'] =='overall_scores'">
                            * {{ trans("imet-core::analysis_report.ranking_rescaled_indicators") }}
                        </div>
                    </template>
                </container_actions>
            </div>
            <div class="horizontal mt-1">
                <div class="sub-title {{ $sub_class ?? '' }}"
                     :id="'menu-average-contribution-'+section+'-'+tableValue['name']">
                    <span v-html="tableValue['menu']['average_contribution']"></span>
                    <button class="btn-nav small blue ml-1">
                        <span class="fas fa-fw fa-info-circle"></span>
                    </button>
                    <tooltip>
                        {{ trans('imet-core::analysis_report.guidance.info.average_contribution') }}}
                    </tooltip>
                </div>
            </div>
            <div :id="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'bar-error'">
                <container_actions :data="section_data"
                                   :name="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'bar-error'"
                                   :event_image="'save_entire_block_as_image'">
                    <template v-slot:default="data_elements">
                        <imet_bar_error
                            :title="tableValue['menu']['average_contribution']"
                            :axis_dimensions_x="{max:100}"
                            :inverse_y="true"
                            :show_legends="true"
                            :legends="data_elements.props[tableValue['name']].average_contribution.legends"
                            :values="data_elements.props[tableValue['name']].average_contribution.data"
                            :height="data_elements.props[tableValue['name']].average_contribution.options.height"
                            :indicators="container.props.stores.BaseStore.parse_indicators(data_elements.props[tableValue['name']].average_contribution.data.Average.map(i => i.label))"></imet_bar_error>
                    </template>
                </container_actions>
            </div>
            <div v-if="tableValue['menu']['radar'] !== ''">
                <div class="horizontal">
                    <div class="sub-title {{ $sub_class ?? '' }}"
                         :id="'menu-radar-'+section+'-'+tableValue['name']">
                        <span v-html="tableValue['menu']['radar']"></span>
                        <button class="btn-nav small blue ml-1">
                            <span class="fas fa-fw fa-info-circle"></span>
                        </button>
                        <tooltip>
                            {{ trans('imet-core::analysis_report.guidance.info.radar') }}}
                        </tooltip>
                    </div>
                </div>
                <div
                    :id="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'scaling-radar'">
                    <container_actions :data="section_data"
                                       :name="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'scaling-radar'"
                                       :event_image="'save_entire_block_as_image'">
                        <template v-slot:default="data_elements">
                            <scaling_radar class="sm" :height=750
                                           :title="tableValue['menu']['radar']"
                                           :single="false"
                                           :radar_indicators_for_negative="data_elements.props[tableValue['name']].radar.radar_indicators_for_negative"
                                           :radar_indicators_for_zero_negative="data_elements.props[tableValue['name']].radar.radar_indicators_zero_negative"
                                           :unselect_legends_on_load="true"
                                           :show_legends="true"
                                           :event_key="'analysis_'+tableValue['name']"
                                           :indicators="data_elements.props[tableValue['name']].radar.indicators"
                                           :values="data_elements.props[tableValue['name']].radar.values"></scaling_radar>
                            <div style="font-size: 12px">
                                {{ trans("imet-core::analysis_report.average_protected_areas") }}
                            </div>
                        </template>
                    </container_actions>
                </div>
                <div
                    :id="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'scaling-datatable-radar'">
                    <container_actions :data="section_data"
                                       :name="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'scaling-datatable-radar'"
                                       :event_image="'save_entire_block_as_image'">
                        <template v-slot:default="data_elements">
                            <datatable_interact_with_radar class="col-sm"
                                                           :event_key="'analysis_'+tableValue['name']"
                                                           :values="data_elements.props[tableValue['name']].radar.values"
                                                           :columns="container.props.stores.BaseStore.find_config_by_name(container.props.config.element_diagrams[section], tableValue['name']).columns.slice(0,-1)">
                            </datatable_interact_with_radar>
                        </template>
                    </container_actions>
                </div>
            </div>
            <div class="horizontal mt-1">
                <div class="sub-title {{ $sub_class ?? '' }}"
                     :id="'menu-datatable-'+section+'-'+tableValue['name']">
                    <span v-html="tableValue['menu']['datatable']"></span>
                    <button class="btn-nav small blue ml-1">
                        <span class="fas fa-fw fa-info-circle"></span>
                    </button>
                    <tooltip>
                        {{ trans('imet-core::analysis_report.guidance.info.datatable') }}}
                    </tooltip>
                </div>
            </div>
            <div :id="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'table-scaling'">
                <container_actions :data="section_data"
                                   :name="'{{$name}}-'+section+'-'+tableValue['name']+'-'+index+'table-scaling'"
                                   :event_image="'save_entire_block_as_image'">
                    <template v-slot:default="data_elements">

                        <datatable_scaling
                            :columns="tableValue.columns"
                            :values="data_elements.props[tableValue['name']].table">
                        </datatable_scaling>

                    </template>
                </container_actions>
            </div>
        </div>
    </div>
</div>

