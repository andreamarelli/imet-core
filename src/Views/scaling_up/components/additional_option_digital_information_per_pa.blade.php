<container_section :id="'{{$name}}'" :title="'{{$title}}'">
    <template slot-scope="container">
        <div class="row">
            <div class="col-sm">
                <div class="align-items-center">
                    <container_view
                        :loaded_at_once="true"
                        :title="'Management effectiveness analysis'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.management_effectiveness_analysis', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="true"
                        :title="'Summary of key elements affecting the management elements'">
                        <template slot-scope="data" class="col-24">
                            @include('imet-core::scaling_up.components.specific_actions_mention', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :title="'Total carbon'"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'getTotalCarbon'">
                        <template slot-scope="data">
                            @include('imet-core::scaling_up.components.total_carbon', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :title="'Terestial ecoregions'"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_pa_ecoregions_terrestial_stats'">
                        <template slot-scope="data" class="contailer">
                            @include('imet-core::scaling_up.components.terestial_ecoregions', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :url=url
                        :title="'Marine ecoregions'"
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_pa_ecoregions_marine_stats'">
                        <template slot-scope="data">
                            @include('imet-core::scaling_up.components.marine_ecoregions', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :title="'Copernicus Global Land Cover'"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_copernicus_land_cover_stats'">
                        <template slot-scope="data">
                            @include('imet-core::scaling_up.components.copernicus', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :title="'Forest Cover'"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_pa_all_indicators'">
                        <template slot-scope="data">
                            @include('imet-core::scaling_up.components.forest_cover', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :url=url
                        :title="'Protected area coverage and connectivity'"
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_country_indicators'">
                        <template slot-scope="data">
                            @include('imet-core::scaling_up.components.protected_area_coverage_and_connectivity', ['name' => $name])
                        </template>
                    </container_view>
                    <container_view
                        :loaded_at_once="false"
                        :title="'Land degradation'"
                        :url=url
                        :parameters="'{{$pa_ids}}'"
                        :func="'get_dopa_wdpa_indicators'">
                        <template slot-scope="data">
                            @include('imet-core::scaling_up.components.land_degradation', ['name' => $name])
                        </template>
                    </container_view>
                </div>
            </div>
        </div>
    </template>
</container_section>