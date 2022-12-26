<template>
    <div class = "chart">

        <v-chart  :option="option" />
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
        color: String
    },
    provide: {
        [THEME_KEY]: "light",
    },
    setup(props) {


        const serie = ref(props.data);
        console.log(props.title)

        const option = ref({
            xAxis: {
                type: 'category',
                data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            },
            yAxis: {
                type: 'value'
            },
            tooltip: {
                trigger: "item",
                formatter: "{a} <br/>{b} : {c} " + props.units
            },
            series: [
                {
                    name: props.title,
                    data: serie,
                    type: 'line',
                    smooth: true
                }
            ],
            color: props.color
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
