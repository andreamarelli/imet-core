<template>

    <div class="imet_responsible">

        <div v-if="to_be_shown['internal'].length>0">
            <b>{{ Locale.getLabel('imet-core::common.responsible_internal') }}</b>:<br />
            <ul>
                <li v-for="resp in to_be_shown['internal']"
                    >{{ resp['Name'] }} <span v-if="resp['Institution']"><i>({{ resp['Institution'] }})</i></span></li>
            </ul>
        </div>

        <div v-if="to_be_shown['external'].length>0">
            <b>{{ Locale.getLabel('imet-core::common.responsible_external') }}</b>:
            <ul>
                <li v-for="resp in to_be_shown['external']"
                    >{{ resp['Name'] }} <span v-if="resp['Institution']"><i>({{ resp['Institution'] }})</i></span></li>
            </ul>
        </div>

        <div v-if="to_be_shown['encoders'].length>0">
            <b>{{ Locale.getLabel('imet-core::common.encoders') }}</b>:
            <ul>
                <li v-for="resp in to_be_shown['encoders']"
                    >{{ resp['name']}} <span v-if="resp['institution']"><i>({{ resp['institution'] }})</i></span></li>
            </ul>
        </div>


        <button class="btn-nav small" v-if="total_count>max_visible && !showHidden" @click=toggleShown ><i class="fas fa-plus-square" /> {{ Locale.getLabel('modular-forms::common.view_all') }}</button>
        <button class="btn-nav small" v-if="showHidden" @click=toggleShown ><i class="fas fa-minus-square" /> {{ Locale.getLabel('modular-forms::common.hide') }}</button>

    </div>


</template>

<style lang="scss" scoped>

</style>

<script>

    export default {

        props: {
            max_visible: {
                type: Number,
                default: 4
            },
            items: {
                type: [String, Object],
                default: () => {
                    return {
                        'internal': [],
                        'external': [],
                        'encoders': [],
                    }
                }
            }
        },

        data: function () {
            return {
                Locale: window.Locale,
                showHidden: false
            }
        },

        computed: {
            total_count(){
                return this.items['internal'].length
                    + this.items['external'].length
                    + this.items['encoders'].length;
            },
            to_be_shown(){
                let _this = this;
                let items = {
                    'internal': [],
                    'external': [],
                    'encoders': [],
                };

                let current_shown = 0;
                Object.values(this.items['internal']).forEach(function (item) {
                    if(current_shown<_this.max_visible || _this.showHidden){
                        if(item['Name']!==null){
                            items['internal'].push(item);
                        }
                    }
                    current_shown++;
                });
                Object.values(this.items['external']).forEach(function (item) {
                    if(current_shown<_this.max_visible || _this.showHidden){
                        if(item['Name']!==null) {
                            items['external'].push(item);
                        }
                    }
                    current_shown++;
                });
                Object.values(this.items['encoders']).forEach(function (item) {
                    if(current_shown<_this.max_visible || _this.showHidden){
                        if(item['name']!==null && item['name'].trim()!=="") {
                            items['encoders'].push(item);
                        }
                    }
                    current_shown++;
                });
                return items;
            }
        },

        methods: {

            toggleShown(){
                this.showHidden = !this.showHidden;
            }

        }
    }

</script>
