<template>
    <div class='bar'></div>
</template>

<style lang="scss" scoped>

</style>

<script>

export default {

    name: "scaling_dopa_chart_bar",

    mixins: [
        window.ImetCore.ScalingUp.Mixins.resize,
        window.ModularForms.Template.chart_bar
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
