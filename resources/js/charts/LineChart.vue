<template>

    <div class = "w-[400px] h-[300px] relative mt-10">
        <div class="flex flex-col gap-1 items-center justify-center w-full" >
            <p class="text-sm text-gray-500">Last {{num}} {{frequencyString}} </p>
            <input type="range" min="3" :max="maxRange" v-on:change="setOption()" v-model="num" class="slider" ref="chart" />
        </div>

        <v-chart id="vchart" ref="chart" :option="option" />

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
        show: Boolean,
        frequency: String
    },
    provide: {
        [THEME_KEY]: "light",
    },
    data() {
        return {
            num: this.data.length,
            option: {
                xAxis: {
                    type: 'category',
                    boundaryGap:false,
                    axisLabel: {
                        /*
                        formatter: (function(value){
                            return moment(value).format('HH:mm');
                        })
                        */

                    }
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
                        data: [],
                        type: 'line',
                        smooth: true
                    }
                ],
                color: this.color
            }
        };
    },
    computed:{
        maxRange(){
            return this.frequency === 'H' ? 24 : 60
        },
        frequencyString(){
            return this.frequency === 'H' ? 'hours':'minutes'
        }
    },
    methods: {
        setOption() {
            this.option.color = this.color
            this.option.series[0].data = this.data.slice(-1*this.num) ;
        },
        updateOptions(){
            this.setOption()
            return this.option
        }
    },
    watch: {
        show: function (old, newVal) {
            /*
            if (this.show) {
                console.log("Data was loaded")
                console.log(this.data)
                this.setOption()

            }
            */

        },
        frequency: function(newVal,old){
            this.num = 3
            console.log(newVal)
            this.$refs.chart.clear()
            this.setOption()
        },
        data: function(newVal,old){
            console.log("Data changed ")
            console.log(newVal)
            this.setOption()
        }
    },
    mounted(){
        this.setOption()
    },
    updated() {
        console.log("Line chart data for "+ this.title)
        console.log(this.data)
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

.loader {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: inline-block;
    position: relative;
    border: 3px solid;
    border-color: #FFF #FFF transparent transparent;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
}
.loader::after,
.loader::before {
    content: '';
    box-sizing: border-box;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    border: 3px solid;
    border-color: transparent transparent #FF3D00 #FF3D00;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    box-sizing: border-box;
    animation: rotationBack 0.5s linear infinite;
    transform-origin: center center;
}
.loader::before {
    width: 32px;
    height: 32px;
    border-color: #FFF #FFF transparent transparent;
    animation: rotation 1.5s linear infinite;
}

@keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
@keyframes rotationBack {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(-360deg);
    }
}

</style>
