<template>

    <selectorDialog
        :parent-id=id
        :search-url=searchUrl
    >

        <!-- dialog anchor -->
        <template v-slot:selector-anchor>
            <div class="field-preview">
                {{ anchorLabel }}
            </div>
        </template>

        <!-- api search - result search filters -->
        <template v-slot:selector-api-search-result-filters>
            <i>{{ Locale.getLabel('modular-forms::common.filter_results') }}: </i>&nbsp;&nbsp;
            {{ Locale.getLabel('imet-core::common.country') }}
            <select v-model=filterByCountry @change="filterList()" class="field-edit filterByCountry">
                <option value="null"> - - </option>
                <option v-for="(label, key) in filteredCountries" :value=key>
                    {{ label }}
                </option>
            </select>
        </template>

        <!-- api search - result header -->
        <template v-slot:selector-api-search-result-header>
            <th>{{ Locale.getLabel('imet-core::common.name') }}</th>
            <th>{{ Locale.getLabel('imet-core::common.protected_area.wdpa_id',1) }}</th>
            <th>{{ Locale.getLabel('imet-core::common.country') }}</th>
            <th>{{Locale.getLabel('imet-core::common.protected_area.iucn_category') }}</th>
        </template>

        <!-- api search - result items -->
        <template v-slot:selector-api-search-result-item="{ item }">
            <td><span class="result_left"><b>{{ item.name }}</b></span></td>
            <td><a v-if="item.wdpa_id!==null" target="_blank" href="https://www.protectedplanet.net/'+item.wdpa_id+'">{{ item.wdpa_id }}</a></td>
            <td>{{ item.country_name }}</td>
            <td>{{ item.iucn_category }}</td>
        </template>

    </selectorDialog>

</template>

<style lang="scss" scoped>
    .result_left{
        text-align: left;
    }
    .field-edit.filterByCountry{
        width: 200px;
        margin: 0 5px;
    }
</style>

<script>


export default {

    // components: {
    //     selectorDialog: selectorDialog
    // },

    mixins: [
        window.ModularForms.MixinsVue.values
    ],

    props: {
        searchUrl: {
            type: String,
            default: null
        },
        dataCountries: {
            type: Object,
            default: () => {}
        }
    },

    data (){
        return {
            Locale: window.Locale,
            assetPath: window.ModularForms.assetPath,
            searchComponent: null,
            selectorComponent: null,
            inputValue: null,
            filterByCountry: null,
        }
    },

    computed:{
        anchorLabel(){
            if(this.selectorComponent!==null && this.selectorComponent.selectedValue !== null){
                return this.selectorComponent.selectedValue['name'];
            }
            return null;
        },
        filteredCountries(){
            // retrieve ISOs from search result
            let found_ISOs = [];
            this.searchComponent.showList.forEach(function (item) {
                if(item.country.includes(';')){
                    item.country.split(";").forEach((iso) => {
                        if(!found_ISOs.includes(iso)){
                            found_ISOs.push(iso);
                        }
                    });
                } else {
                    if(!found_ISOs.includes(item.country)){
                        found_ISOs.push(item.country);
                    }
                }
            });
            // filter list of countries according to search result
            let filtered_countries = {};
            for (const [key, value] of Object.entries(this.dataCountries)) {
                if(found_ISOs.includes(key)){
                    filtered_countries[key] = value;
                }
            }
            return filtered_countries;
        }
    },

    mounted (){
        this.selectorComponent = this.$children[0];
        this.searchComponent = this.$children[0].$children[0].$children[0];
    },

    methods: {

        afterSearch(data){
            // this.orders = data['orders'];
            // this.classes = data['classes'];
            this.filterByCountry = null;
        },


        filterList(){
            let filters = {
                'country': this.filterByCountry
            };
            this.searchComponent.filterShowList(filters);
        },

        getSelectedValue(value){
            return this.selectorComponent.selectedValue['wdpa_id'];
        }

    }



}
</script>
