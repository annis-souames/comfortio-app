<template>
    <div class = "chart">

        <v-chart  :option="option" />
    </div>

</template>

<script>
import { use } from "echarts/core";
import { CanvasRenderer } from "echarts/renderers";
import { GaugeChart } from "echarts/charts";
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
    GaugeChart,
    GridComponent,
    TitleComponent,
    TooltipComponent,
    LegendComponent,
]);

export default {
    name: "TempGauge",
    components: {
        VChart,
    },
    props: {
        title: String,
        units: String,
        data: Array,
    },
    provide: {
        [THEME_KEY]: "light",
    },
    setup(props) {


        const serie = ref(props.data);
        console.log(props.title)

        const option = ref({
            series: [
                {
                    type: 'gauge',
                    center: ['50%', '60%'],
                    startAngle: 200,
                    endAngle: -20,
                    min: 0,
                    max: 60,
                    splitNumber: 12,
                    itemStyle: {
                        color: '#FFAB91'
                    },
                    progress: {
                        show: true,
                        width: 30
                    },
                    pointer: {
                        show: false
                    },
                    axisLine: {
                        lineStyle: {
                            width: 30
                        }
                    },
                    axisTick: {
                        distance: -45,
                        splitNumber: 5,
                        lineStyle: {
                            width: 2,
                            color: '#999'
                        }
                    },
                    splitLine: {
                        distance: -52,
                        length: 14,
                        lineStyle: {
                            width: 3,
                            color: '#999'
                        }
                    },
                    axisLabel: {
                        distance: -20,
                        color: '#999',
                        fontSize: 20
                    },
                    anchor: {
                        show: false
                    },
                    title: {
                        show: false
                    },
                    detail: {
                        valueAnimation: true,
                        width: '60%',
                        lineHeight: 40,
                        borderRadius: 8,
                        offsetCenter: [0, '-15%'],
                        fontSize: 60,
                        fontWeight: 'bolder',
                        formatter: '{value} °C',
                        color: 'auto'
                    },
                    data: [
                        {
                            value: props.data
                        }
                    ]
                },
                {
                    type: 'gauge',
                    center: ['50%', '60%'],
                    startAngle: 200,
                    endAngle: -20,
                    min: 0,
                    max: 60,
                    itemStyle: {
                        color: '#FD7347'
                    },
                    progress: {
                        show: true,
                        width: 8
                    },
                    pointer: {
                        show: false
                    },
                    axisLine: {
                        show: false
                    },
                    axisTick: {
                        show: false
                    },
                    splitLine: {
                        show: false
                    },
                    axisLabel: {
                        show: false
                    },
                    detail: {
                        show: false
                    },
                    data: [
                        {
                            value: props.data
                        }
                    ]
                }
            ]
        });

        return {
            option,
            serie
        }
    },
};



</script>

<style scoped>
.chart{
    height: 400px;
    width: 400px;
}
</style>
