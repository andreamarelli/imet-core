<template>

    <div class='doughnut'></div>

</template>

<style lang="scss" scoped>

</style>

<script>

export default {

    name: "scaling_dopa_chart_doughnut",

    mixins: [
        window.ImetCore.ScalingUp.Mixins.resize,
        window.ModularForms.Dopa.chart_doughnut
    ],

    methods: {
        draw_chart() {
            let options = this.set_options();
            this.chart = echarts.init(this.$el);
            this.chart.setOption(options);
        }
    }
}
</script>
