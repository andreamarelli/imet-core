<template>
    <div class="module-container" :id="name">
        <div class="module-header">
            <div v-if="code_is_visible()" class="module-code text-center">
                {{ code }}
            </div>
            <div class="module-title" @click="toggle_view()">
                      <span class="fas fa-fw carrot"
                            :class="{'fa-caret-up': !data.show_view,'fa-caret-down':data.show_view}"></span> {{ title }}
            </div>
        </div>
        <div class="module-body bg-white collapse" :class="{show: data.show_view}">
            <guidance :text="guidance"/>
            <slot :props="data">
            </slot>
            <div class="text-right mt-3">
                <div class="btn btn-circle btn-outline-danger" @click="toggle_view()" v-html="stores.BaseStore.localization('imet-core::analysis_report.close')">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import container_event from './container_event.vue';

export default {
    name: "container_section",
    inject: ['stores', 'config'],
    mixins: [
        container_event
    ],
    provide: {
        state:
            {
                image_src: '',
                comment: null
            }
    },
    props: {
        name: {
            type: String,
            default: ''
        },
        title: {
            type: String,
            default: ''
        },
        code: {
            type: String,
            default: ''
        },
        guidance: {
            type: String,
            default: ''
        }
    },
    data: function () {
        return {
            data: {
                values: {},
                show_view: false,
                loaded_once: false,
                config: this.config,
                stores: this.stores
            }
        }
    },
    methods: {
        code_is_visible() {
            return this.code.length;
        },
        toggle_view: async function () {
            this.data.show_view = !this.data.show_view;
        },
        is_visible: function (values) {
            return Object.keys(values).length;
        }
    }
}
</script>
