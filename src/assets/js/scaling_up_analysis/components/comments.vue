<template>
    <div style="display: flex;" id="comments">
        <div>
            <div>
                <table>
                    <tr v-for="(value,idx) in values" rowspan="2">
                        <td class="content">
                            <div id="menu-header-header-main" class="list-key-numbers horizontal">
                                <div class="list-head">{{ idx }}</div>
                            </div>
                            <div v-if="Object.entries(value).length > 0" v-for="(items, k) in value" class="row mt-2">
                                <div class="col-12"><strong>{{ k }}</strong></div>
                                <div v-for="(item, key) in items" class="col-12 mt-2">
                                    {{ item }}
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    name: "comments",
    inject: ['stores'],
    props: {
        values: {
            type: [Array, Object],
            default: () => {
            }
        }
    },
    data: function () {
        return {
            comments: []
        }
    },
    mounted() {
        this.init(this.values);
    },
    methods: {


        init: function (response) {

            console.log({response});
        }
    }
}


</script>

<style scoped>
table {
    border-collapse: separate;
    border-spacing: 0 20px;
}
</style>
