<template>
    <div class = "w-[400px] h-[300px] relative mt-10">
        <div class="flex flex-col gap-1 items-center justify-center w-full">
            <p class="text-sm text-gray-500">Hours to display:</p>
            <input type="range" :min="0" :max="this.data.length" v-on:input="setOption()" v-model="num" class="slider" ref="chart" />
        </div>

        <v-chart id="vchart"  :option="option"/>
    </div>

</template>

<script>
import { use } from "echarts/core";
import { CanvasRenderer } from "echarts/renderers";
import { LineChart } from "echarts/charts";
import {
    GridComponent,
    TooltipComponent,
    LegendComponent,
    TitleComponent,
} from "echarts/components";
import VChart, { THEME_KEY } from "vue-echarts";
import {ref} from 'vue';

use([
    CanvasRenderer,
    LineChart,
    GridComponent,
    TitleComponent,
    TooltipComponent,
    LegendComponent,
]);

export default {
    name: "LineChart",
    components: {
        VChart,
    },
    props: {
        title: String,
        resultSet: Object,
        units: String,
        data: Array,
        labels: Array,
        color: String,
    },
    provide: {
        [THEME_KEY]: "light",
    },
    data() {
        return {
            num: this.data.length,
            option: null,
        };
    },
    methods: {
        setOption() {
            this.option = ref({
                xAxis: {
                    type: 'category',
                    data: this.labels.slice(0, this.num),
                },
                yAxis: {
                    type: 'value'
                },
                tooltip: {
                    trigger: "item",
                    formatter: "{a} <br/>{b} : {c} " + this.units
                },
                series: [
                    {
                        name: this.title,
                        data: this.data.slice(0, this.num),
                        type: 'line',
                        smooth: true
                    }
                ],
                color: this.color
            });
        },
    },
    mounted() {
        this.setOption()
    },

    // setup(props) {

    //     const serie = ref(props.data);

    //     // console.log(props.title);

    //     const option = ref({
    //         xAxis: {
    //             type: 'category',
    //             data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    //         },
    //         yAxis: {
    //             type: 'value'
    //         },
    //         tooltip: {
    //             trigger: "item",
    //             formatter: "{a} <br/>{b} : {c} " + props.units
    //         },
    //         series: [
    //             {
    //                 name: props.title,
    //                 data: serie,
    //                 type: 'line',
    //                 smooth: true
    //             }
    //         ],
    //         color: props.color
    //     });

    //     return {
    //         option,
    //         serie
    //     }
    // },
};



</script>

<style scoped>
/* .chart{
    height: 400px;
    width: 400px;
} */

.slider {
  -webkit-appearance: none;
  width: 50%;
  height: 20px;
  border-radius: 10px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}
.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: rgb(59 130 246);
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: rgb(59 130 246);
  cursor: pointer;
}
</style>
