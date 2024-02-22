
module.exports = {

    data() {
        return {
            previous_url: null
        }
    },

    props: {
        current_year: {
            type: String,
            default: null
        },
        current_pa: {
            type: String,
            default: null
        },
        available_years: {
            type: [Array, Object],
            default: () => null
        },
        prev_year_selection: {
            type: String,
            default: null
        },
        show_language: {
            type: Boolean,
            default: true
        },
        retrieving_years: {
            type: Boolean,
            default: false
        }
    },

    watch: {
        prev_year_selection(value) {
            this.show_language = value === null || value === 'no_import';
            let record = this.records[0];
            record['prev_year_selection'] = value;
            this.$set(this.records, 0, record);
        },
        records: {
            handler: function () {
                this.recordChangedCallback();
            },
            deep: true
        }
    },

    methods: {

        async recordChangedCallback() {
            // empty prev_year_selection if wdpa or year changes
            if (this.current_pa !== this.records[0]['wdpa_id'] &&
                this.current_year !== this.records[0]['Year']
            ) {
                this.prev_year_selection = null;
                this.available_years = null;
            }
            // retrieve prev_year_selection
            if (![null, ""].includes(this.records[0]['wdpa_id']) &&
                ![null, ""].includes(this.records[0]['Year']) &&
                (this.current_pa !== this.records[0]['wdpa_id'] ||
                    this.current_year !== this.records[0]['Year'])
            ) {
                try {
                    const response = await this.retrievePreviousYears();
                    this.retrieving_years = false;
                    if (Object.values(response).length > 0) {
                        this.parseAvailableYears(response);
                    } else {
                        this.available_years = null;
                    }
                } catch (e) {
                    this.retrieving_years = false;
                    this.available_years = null;
                }
            }
            // show SAVE bar only when all fields have been selected
            if (![null, ""].includes(this.records[0]['Year']) &&
                ![null, ""].includes(this.records[0]['wdpa_id']) &&
                (
                    (this.prev_year_selection === 'no_import' && this.records[0]['language'] !== null) ||
                    (this.prev_year_selection !== 'no_import' && this.prev_year_selection !== null) ||
                    (this.available_years === null && this.records[0]['language'] !== null)
                )
            ) {
                this.status = 'idle';
            } else {
                this.status = 'init';
            }
            this.status = (this.status !== 'init' && this.status !== 'changed') ? 'changed' : this.status;

            // store selections
            this.current_pa = this.records[0]['wdpa_id'];
            this.current_year = this.records[0]['Year'];
        },

        resetModuleCallback() {
            this.reset_status = 'init';
        },

        async retrievePreviousYears() {
            let _this = this;
            _this.available_years = null;
            _this.retrieving_years = true;

            return fetch(this.previous_url, {
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": window.Laravel.csrfToken,
                },
                body: JSON.stringify({
                    year: _this.records[0]['Year'],
                    wdpa_id: _this.records[0]['wdpa_id']
                })
            })
        .then((response) => response.json())
        },

        parseAvailableYears(data) {
            let _this = this;
            this.available_years = data;
            this.available_years['no_import'] = 'No';
            let years = Object.values(this.available_years);
            let duplicates = this.foundDuplicates(years);
            Object.keys(this.available_years).forEach(function (key) {
                if (duplicates.includes(_this.available_years[key])) {
                    _this.available_years[key] = _this.available_years[key] + ' (IMET #' + key + ')';
                }
            });
        },

        foundDuplicates(list) {
            let sorted_arr = list.slice().sort();
            let results = [];
            for (let i = 0; i < sorted_arr.length - 1; i++) {
                if (sorted_arr[i + 1] === sorted_arr[i]) {
                    results.push(sorted_arr[i]);
                }
            }
            return results;
        }

    }

}