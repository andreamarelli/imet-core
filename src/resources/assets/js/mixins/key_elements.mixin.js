export default {

    methods: {

        key_element_label: function(value) {

            this.Locale = window.Locale;

            if (value !== null) {
                if (this.isTaxonomy(value)) {
                    return this.getScientificName(value);
                } else if (this.isHabitat(value)) {
                    return this.getHabitatLabel(value);
                }
            }
            return value;
        },

        isTaxonomy: function(value) {
            return (value.match(/\|/g) || []).length === 5
        },

        getScientificName: function(value) {
            let taxonomy = value.split("|");
            return taxonomy[4] + ' ' + taxonomy[5]
        },

        isHabitat: function(value) {
            return !this.Locale.getLabel('imet-core::v2_lists.Habitats.' + value).includes('::v2_lists')
        },

        getHabitatLabel: function(value) {
            return this.Locale.getLabel('imet-core::v2_lists.Habitats.' + value)
        }

    }

}