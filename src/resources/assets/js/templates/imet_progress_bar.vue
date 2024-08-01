<template>

    <div class="progress-bar text-2xs">

        <div v-if="showLimits && min!==null" class="progress-bar__limit-left">{{ min }}%</div>

        <progress_bar
            :value=progress_value
            :color=color
        ></progress_bar>

        <div v-if="showLimits && max!==null" class="progress-bar__limit-right">{{ max }}%</div>

    </div>

</template>

<style lang="scss" scoped>

    .progress-bar{
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        width: 100%;
        align-items: center;
        margin: 1px 0;

      .progress-bar__limit-left,
      .progress-bar__limit-right{
          width: 40px;
          font-weight: bold;
      }

        .progress-bar__limit-left{
            text-align: right;
            padding-right: 3px;
        }

        .progress-bar__limit-right{
            text-align: left;
            padding-left: 3px;
        }
    }

</style>

<script setup>

import { computed } from "vue";
import progress_bar from "./progress_bar.vue";

const props = defineProps({
    value: {
        type: [String, Number],
        default: 0
    },
    color: {
        type: String,
        default: '#ccc'
    },
    showLimits: {
        type: Boolean,
        default: true
    },
    min: {
        type: Number,
        default: 0
    },
    max: {
        type: Number,
        default: 100
    },
});

const progress_value = computed(() => {
    return typeof props.value === 'number'
        ? parseFloat(props.value)
        : props.value;
});


</script>
