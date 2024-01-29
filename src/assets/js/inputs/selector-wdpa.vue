<template>

    <selectorDialog
            :parent-id=id
            :search-url=searchUrl
            :enable-free-text=enableFreeText
    >

        <!-- dialog anchor -->
        <template v-slot:selector-anchor>
            <div class="field-preview">
                {{ anchorLabel }}
            </div>
        </template>

        <!-- api search - result search filters -->
        <template v-slot:selector-api-search-result-filters>
            hello filters
        </template>

        <!-- api search - result header -->
        <template v-slot:selector-api-search-result-header>
            <th></th>
            <th></th>
            <th></th>
        </template>

        <!-- api search - result items -->
        <template v-slot:selector-api-search-result-item="{ item }">
            <td></td>
            <td></td>
            <td></td>
        </template>

    </selectorDialog>

</template>

<style lang="scss" scoped>
    .result_left{
        text-align: left;
    }
    .field-edit.filterByClass,
    .field-edit.filterByOrder{
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
        enableFreeText: {
            type: Boolean,
            default: false,
        },
    },

    data (){
        return {
            Locale: window.Locale,
            assetPath: window.ModularForms.assetPath,
            searchComponent: null,
            inputValue: null,
            filterByClass: null,
            filterByOrder: null,
            orders: [],
            classes: []
        }
    },

    computed:{
        anchorLabel(){
            return this.inputValue;
        }
    },

    mounted (){
        this.searchComponent = this.$children[0].$children[0].$children[0];
    },

    methods: {

        getScientificName(item) {
            return item.genus + ' ' + item.species;
        },

        getFullTaxonomy(item) {
            return item.phylum + '|' + item.class + '|' + item.order + '|' + item.family + '|' + item.genus + '|' + item.species
        },

        getSpeciesDescription(item) {
            let description = '<div>' + item.class + ' ' + item.order + ' ' + item.family + ' <b>' + item.genus + ' ' + item.species + '</b>' + '</div>';
            if (this.hasCommonNames(item)) {
                description += '<div class="common_names"><b><i>' + Locale.getLabel('modular-forms::entities.biodiversity.common_names') + ':</i></b><br />';
                if (item.common_name_en !== null && item.common_name_en.toLowerCase() !== 'null') {
                    description += '<div><span class="flag-icon flag-icon-gb"></span> ' + item.common_name_en.replace(/\,/g, ', ') + '</div>'
                }
                if (item.common_name_fr !== null && item.common_name_fr.toLowerCase() !== 'null') {
                    description += '<div><span class="flag-icon flag-icon-fr"></span> ' + item.common_name_fr.replace(/\,/g, ', ') + '</div>'
                }
                if (item.common_name_sp !== null && item.common_name_sp.toLowerCase() !== 'null') {
                    description += '<div><span class="flag-icon flag-icon-es"></span> ' + item.common_name_sp.replace(/\,/g, ', ') + '</div>'
                }
                description += '</div>';
            }
            return description;
        },

        hasCommonNames(item) {
            return (item.common_name_en !== null || item.common_name_fr !== null || item.common_name_sp !== null);
        },

        afterSearch(data){
            this.orders = data['orders'];
            this.classes = data['classes'];
            this.filterByOrder = null;
            this.filterByClass = null;
        },

        orderByClass(){
            return this.filterByClass!=null
                ? this.orders[this.filterByClass]
                : [];
        },

        filterList(alsoResetOrder){
            if(alsoResetOrder){
                this.filterByOrder = null;
            }
            this.filterByOrder = typeof this.filterByOrder === "undefined" ? null : this.filterByOrder;

            let filters = {
                'class': this.filterByClass,
                'order': this.filterByOrder,
            };
            this.searchComponent.filterShowList(filters);
        },

        getSelectedValue(value){
            return this.getFullTaxonomy(value);
        }

    }



}
</script>
