<template>
    <div class="imet_bar_error" :style="'width:100%; height: '+height+';'"></div>
</template>

<script>

export default {
    mixins: [
        window.ImetCore.ScalingUp.Mixins.resize
    ],
    inject: ['stores'],
    props: {
        title: {
            type: String,
            default: ''
        },
        width: {
            type: String,
            default: '100%'
        },
        height: {
            type: String,
            default: '600px'
        },
        values: {
            type: [Object, Array],
            default: () => {
            }
        },
        indicators: {
            type: Array,
            default: () => {
            }
        },
        indicators_color: {
            type: String,
            default: ''
        },
        legends: {
            type: Array,
            default: () => {
            }
        },
        show_legends: {
            type: Boolean,
            default: false
        },
        font_size: {
            type: Number,
            default: 13
        },
        options: {
            type: [Object, Array],
            default: () => {
            }
        },
        axis_dimensions_x: {
            type: Object,
            default: () => {
            }
        },
        axis_dimensions_y: {
            type: Object,
            default: () => {
            }
        },
        error_color: {
            type: String,
            default: '#C23531'
        },
        inverse_y: {
            type: Boolean,
            default: false
        },
        inverse_x: {
            type: Boolean,
            default: false
        },
    },
    data: function () {
        const Locale = window.Locale;
        return {
            Locale: Locale,
            gather_colors: []
        }
    },
    computed: {
        bar_options() {
            const {values, error_data, legends, indicators} = this.getValues();

            return {
                title: {
                    text: this.title,
                    left: 'center',
                    textStyle: {
                        fontWeight: 'normal'
                    }
                },
                legend: {
                    show: this.show_legends,
                    data: this.legends,
                    padding: [30, 0, 0, 0]
                },
                ...this.grid(),
                xAxis: {...this.axis_dimensions_x, inverse: this.inverse_x},
                yAxis: {
                    data: indicators,
                    inverse: this.inverse_y,
                    axisLabel: {
                        fontSize: this.font_size,
                        interval: 0,
                        width: 0,
                        rotate: 0,
                        formatter: function (value) {
                            if (value.length < 35) {
                                return value.split(' ').join('\n')
                            }
                            const max_size = 16;
                            const reg = new RegExp(`.{${max_size}}`, 'g'); // /.{10}/g;
                            const pieces = value.match(reg);
                            const accumulated = (pieces.length * max_size);
                            const modulo = value.length % accumulated;
                            if (modulo) pieces.push(value.slice(accumulated));
                            return pieces.join('\n');
                        }
                    }
                },
                series: this.bar_item(values, error_data)
            }
        }
    },
    watch: {
        values: {
            deep: true,
            handler() {
                this.draw_chart();
            }
        }
    },
    methods: {
        grid: function () {
            return {
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                }
            }
        },
        render_item: function (params, api) {
            let xValue = api.value(0);
            let highPoint = api.coord([api.value(1), xValue]);
            let lowPoint = api.coord([api.value(2), xValue]);
            let halfWidth = api.size([0, 1])[1] * 0.2;
            let style = api.style({
                stroke: api.visual('color'),
                fill: null
            });
            return {
                type: 'group',
                toolbox: {
                    show: true,
                    feature: {
                        saveAsImage: {
                            type: 'png',
                            show: true
                        },
                        dataView: {readOnly: false},
                        magicType: {type: ['line', 'bar']},
                    }
                },
                children: [{
                    type: 'line',
                    transition: ['shape'],
                    shape: {
                        x1: highPoint[0], y1: highPoint[1] - halfWidth,
                        x2: highPoint[0], y2: highPoint[1] + halfWidth
                    },
                    style: style
                }, {
                    type: 'line',
                    transition: ['shape'],
                    shape: {
                        x1: highPoint[0], y1: highPoint[1],
                        x2: lowPoint[0], y2: lowPoint[1]
                    },
                    style: style
                }, {
                    type: 'line',
                    transition: ['shape'],
                    shape: {
                        x1: lowPoint[0], y1: lowPoint[1] - halfWidth,
                        x2: lowPoint[0], y2: lowPoint[1] + halfWidth
                    },
                    style: style
                }]
            };
        },
        setIndicators: function () {
            if (!this.indicators?.length) {
                return [];
            }
            if (this.values.Average) {
                return this.values.Average.map((value, key) => {
                    return value['indicator'];
                });
            }
            return this.values.map((value, key) => {
                return value['indicator'];
            });
        },
        colors: function (colors) {
            return colors;
        },
        getValues: function (data = this.values) {
            let values = []
            let indicators = [];
            let legends = [];
            let error_data = [];

            indicators = this.setIndicators();

            Object.entries(data)
                .reverse()
                .forEach(([key, value]) => {
                    const name = key.replace(' ', '\n');

                    if (!this.indicators?.length) {
                        indicators.push(name);
                    }

                    if (key === 'Average') {
                        values = value.map((i, k) => {
                            this.gather_colors[i['itemStyle']['color']] = i['itemStyle']['color'];
                            return {'value': i['value'], 'itemStyle': {'color': i['itemStyle']['color']}}
                        });
                        error_data = value.map((i, k) => [k, ...i['upper limit']]);
                    }
                });

            return {values, error_data, legends, indicators};
        },

        line_style: function (value, color = null) {
            return {
                lineStyle: {
                    type: value,
                    color
                }
            }
        },
        bar_item: function (bar_data, error_data) {
            const color = bar_data[0].itemStyle.color;
            return [
                {
                    type: 'bar',
                    name: this.legends[0],
                    data: bar_data.map(data => {
                        return {value: data.value, itemStyle: {color: data.itemStyle.color}, label: {color: "#000000"}}
                    }),
                    itemStyle: {
                        color
                    },
                    label: {
                        show: true,
                        position: 'inside',
                        fontSize: 14
                    }
                }, {
                    type: 'custom',
                    name: this.legends[1],
                    itemStyle: {
                        normal: {
                            borderWidth: 1.5,
                            color: this.error_color
                        }
                    },
                    renderItem: this.render_item,
                    encode: {
                        x: [1, 2],
                        y: 0
                    },
                    label: {
                        show: false
                    },
                    data: error_data,
                    z: 100
                }]
        },

        draw_chart() {
            if (Object.keys(this.values).length > 0) {
                this.chart = echarts.init(this.$el);
                this.chart.setOption(this.bar_options);
            }
        }
    }

}
</script>
