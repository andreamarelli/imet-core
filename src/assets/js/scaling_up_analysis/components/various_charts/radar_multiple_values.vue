<template>
  <div class="imet_radar" :style="'width:100%; height: 100%;'"></div>
</template>

<script>

export default {
  name: "radar_multiple_values",
  props: {
    width: {
      type: Number,
      default: 180
    },
    height: {
      type: Number,
      default: 180
    },
    values: {
      type: Object,
      default: () => {
      }
    },
    indicators: {
      type: Array,
      default: () => {
      }
    },
    show_legends: {
      type: Boolean,
      default: false
    },
    single: {
      type: Boolean,
      default: true
    },
    showOnlyScaling: {
      type: Boolean,
      default: false
    },
    unselect_legends_on_load: {
      type: Boolean,
      default: false
    }
  },
  data: function () {
    return {
      default_colors: ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#3ba272', '#fc8452', '#9a60b4', '#ea7ccc'],
      legend_selected: []
    }

  },
  computed: {
    radar_options() {
      let items = [];
      if (this.single) {
        items = this.singleData();
      } else {
        //console.log({item: this.values})
        items = this.multipleData();
      }

      return {
        color: this.default_colors,
        tooltip: {
          trigger: 'axis'
        },
        //nameGap: 0,
        ...items.legends,
        radar: {
          indicator: items.indicators,
          radius: '70%',
          startAngle: 90,
          axisLabel: {
            show: true,
            align: 'right'
          },
          name: {
            lineHeight:18,
            textStyle: {
              color: '#111',
              padding: [0, 0]
            }
          },
        },
        series: [{
          name: '',
          type: 'radar',
          data: items.render_items
        }]
      };
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
  mounted() {
    this.draw_chart();
  },
  methods: {
    createItemsForScalingNumbers: function () {
      const render_items = [];
      if (this.showOnlyScaling) {
        const indi_length = this.indicators.length;
        this.indicators.forEach((i, k) => {
          const item = this.radar_item();
          item.value = new Array(indi_length).fill(0);
          item.value[0] = (20 * (k));
          item.lineStyle.color = 'rgba(255, 255, 255, 0)';

          render_items.push(item);
        })
      }
      ;
      return render_items;
    },
    setIndicators: function () {
      if (!this.indicators?.length) {
        return [];
      }
      return this.indicators.map((value, key) => {
        return {text: value.replace(' ', '\n'), max: 100};
      });
    },
    colors: function (colors) {
      return colors;
    },
    legends: function (legends = null) {
      if (!legends) {
        return null;
      }
      return {
        legend: {
          data: legends,
          padding: [5, 5, 10, 5]
        }
      }

    },
    setLegends: function () {
      const legends = [];
      Object.entries(this.values)
          .reverse()
          .forEach(([key, value]) => {
            legends.push({name: key});
          });
      return this.legends(legends);
    },
    singleData: function () {
      const render_items = [];
      const item = this.radar_item();
      const indicators = [];
      let legends = [];
      Object.entries(this.values).reverse().forEach((data, key) => {
        indicators.push({text: data[0].replace(' ', '\n'), max: 100});
        item.value.push(data[1]);
      });
      render_items.push(item);
      return {render_items, legends, indicators};
    },
    multipleData: function () {
      let indicators = [];
      let legends = [];
      const render_items = [];

      indicators = this.setIndicators();
      if (this.show_legends) {
        legends = this.setLegends(this.values);
      }

      Object.entries({...this.values}).reverse().forEach((data, key) => {
        const item = this.radar_item();
        const name = data.shift();
        item.name = name;

        Object.entries(data)
            .forEach(([key, value]) => {
              if (value === Object(value)) {
                if (this.showOnlyScaling) {
                  item.label.normal.show = value.label_show ?? true;
                }
                item.symbolSize = 0;
                item.lineStyle.type = value?.lineStyle;
                item.lineStyle.color = value?.color;
                item.itemStyle.color = value?.color;
                if (value.legend_selected) {
                  this.legend_selected.push(name)
                }
                item.tooltip = {
                  trigger: 'item'
                };
                //todo check it again
                //delete value['lineStyle'];
                //delete value['color'];
                //delete value['label_show'];
                value = Object.values(value);
              }
              item.value = value;

            });
        render_items.push(item);
      });

      render_items.push(...this.createItemsForScalingNumbers());
      return {render_items, legends, indicators};
    },
    radar_item: function () {
      return {
        value: [],
        name: '',

        itemStyle: {
          color: null
        },
        lineStyle: {
          type: 'solid',
          color: null
        },
        label: {
          normal: {
            fontWeight: 'bold',
            color: '#222',
            show: true
          }
        }
      }
    },
    draw_chart() {
      if (Object.keys(this.values).length > 1) {
        this.chart = echarts.init(this.$el);
        this.chart.setOption(this.radar_options);

        if (this.unselect_legends_on_load) {
          this.unselect_all_legends(this.radar_options?.legend?.data);
        }
      }
    },
    unselect_all_legends: function (legends) {
      const _this = this;
      legends.forEach(legend => {
        if (!_this.legend_selected.includes(legend.name)) {
          _this.chart.dispatchAction({
            type: 'legendUnSelect',
            name: legend.name
          });
        }
      })

    }
  }
}

</script>