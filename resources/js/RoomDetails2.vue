<template>
    <div @click="$emit('close-modal')" class="flex items-center justify-center modal z-[1000]" :class="this.show ? 'active' : ''">

        <div v-on:click.stop class="bg-gray-100 modal__content w-[80%] h-[95%] z-[1001] flex flex-col relative">
            <div @click="$emit('close-modal')" class="absolute top-0 right-0 mt-5 mr-5">
                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
            </div>

            <div class="flex py-4 items-center justify-center w-full space-x-3">
                <h1 v-if="this.room !== null" class="font-bold text-xl">{{this.room.name}} details:</h1>

                <div class="flex items-center justify-center absolute right-20  " >
                    <ul class="flex flex-row font-medium text-center text-gray-500 border border-black">
                        <li class="flex grow button1 py-1 px-2 w-1/2 text-md" :class = 'freq === "H" ? "activeTab" : ""' @click='updateDataFrequency("H")'>
                            <a href="#">Hourly</a>
                        </li>
                        <li class="flex grow button2 py-1 px-2 w-1/2 text-md" :class = 'freq === "M" ? "activeTab" : ""' @click='updateDataFrequency("M")'>
                            <a href="#">Minute</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 place-items-center px-10 h-[80%] overflow-y-auto">
                <PropDetails title="Temperature" >
                    <template v-slot:chart1 >
                        <Thermometer value="30"/>
                    </template>

                    <template v-slot:chart2>

                        <!-- <input type="text" min="1" max="100" v-model="roomData" class="mt-5" ref="chart" />
                        <p>{{ roomData }}</p> -->
                        <div class = "w-full">
                            <LineChart
                                :frequency="freq"
                                title="Temperature" units="°C"
                                color="#FFA600"
                                :data="roomData.temperature"
                                :labels="label_arr"

                            ></LineChart>

                        </div>

                    </template>
                </PropDetails>

                <PropDetails title="Humidity">
                    <template v-slot:chart1>
                        <HumidityIndicator value="70"/>
                    </template>

                    <template v-slot:chart2>
                        <LineChart
                            :frequency="freq"
                            title="Humidity" units="%"
                            color="#58508D"
                            :data="roomData.humidity"
                            :labels="label_arr"

                        ></LineChart>

                    </template>
                </PropDetails>

                <PropDetails title="Light" >
                    <template v-slot:chart1>
                        <LightIndicator value="30"/>
                    </template>

                    <template v-slot:chart2>
                        <LineChart
                            :frequency="freq"
                            title="Light" units="%"
                            color="#58508D"
                            :data="roomData.light"
                            :labels="label_arr"

                        ></LineChart>
                    </template>
                </PropDetails>

                <PropDetails title="Sound" >
                    <template v-slot:chart1>
                        <SoundIndicator value="80"/>
                    </template>

                    <template v-slot:chart2>
                        <LineChart
                            :frequency="freq"
                            title="Sound" units="%"
                            color="#58508D"
                            :data="roomData.sound"
                            :labels="label_arr"


                        ></LineChart>
                    </template>
                </PropDetails>

            </div>

            <div class="flex flex-grow items-center justify-center text-center border-t border-black">
                <button class="modal-close px-4 bg-blue-500 p-3 rounded-lg text-white hover:bg-blue-400 transition ease-in-out duration-150">Take action</button>
            </div>

        </div>
    </div>
</template>

<script>
import LineChart from "./charts/LineChart.vue";
import TempGauge from "./charts/TempGauge.vue";
import PropDetails from "./PropDetails.vue";
import Thermometer from "./charts/Thermometer.vue";
import HumidityIndicator from "./charts/HumidityIndicator.vue";
import LightIndicator from "./charts/LightIndicator.vue";
import SoundIndicator from "./charts/SoundIndicator.vue";
import axios from 'axios';
export default {
    name: "RoomDetails2",
    components: { TempGauge, LineChart, HumidityIndicator, Thermometer, LightIndicator, SoundIndicator, PropDetails },
    props: [
        'room',
        'show',
    ],
    data() {
        return {
            dataState: {
                temperature: "current",
                humidity: "current",
                light: "current",
                sound: "light",
            },
            dataLoading:true,
            roomData : {
                temperature : [],
                humidity: [],
                light: [],
                sound: []
            },
            label_arr: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            freq: "H",
            freqs: {
                temperature: "H",
                humidity: "H",
                light: "H",
                sound: "H",
            }
        };
    },
    created() {
      console.log("Modal shown from created")
    },
    mounted(){
        console.log("Modal shown from mounted")
        this.dataLoading = true

        axios.get('http://localhost:8000/api/details',{params:{id:this.room.id,by:this.freq}}).then((resp) => {
            console.log(resp)
            this.roomData = resp.data
            this.dataLoading = false

        })
    },
    updated() {
        if(this.show){
            console.log("Modal shown from updated")

        }
    },
    methods: {
        close(el) {
            $emit('close-modal');
        },
        updateDataFrequency(freq){
            console.log("Hi")
            this.freq = freq
            this.dataLoading = true
            axios.get('http://localhost:8000/api/details',{params:{id:this.room.id,by:this.freq}}).then((resp) => {
                console.log(resp)
                this.roomData = resp.data
                this.dataLoading = false
            })
        }
    }
};
</script>

<style lang="scss" scoped>
.modal {
    opacity: 0;
    visibility: hidden;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba($color: #000000, $alpha: 0.6);
    pointer-events: none;
    transition: 0.3s ease-in-out;

    &.active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }
}
</style>
