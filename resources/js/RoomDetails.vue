<template>
    <div class="modal fixed bg-gray-50 w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-50 "></div>

        <div class="modal-container fixed w-full h-full z-50 overflow-y-auto ">

            <div @click="$emit('close-modal')" class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-black text-sm z-50">
                <svg  class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
                (Esc)
            </div>

            <!-- Add margin if you want to see grey behind the modal-->
            <div class="modal-content container mx-auto h-auto text-left p-4">

                <!--Title-->
                <div class="flex justify-between items-center pb-2">
                    <p class="text-2xl font-bold">{{room.name}} details : </p>
                </div>
                <hr class = "text-gray-500"/>
                <!--Body-->
                <div class = "flex mb-4 mt-2">
                    <div class = "w-1/2 card bg-white rounded-md px-2 py-1 mx-4">
                        <div class = "card-header w-full flex inline-flex justify-between">
                            <h3 class = "text-xl font-semibold ml-2">Temperature</h3>

                            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                                <li class="mr-2" @click = 'dataState.temperature = "current"'>
                                    <a href="#" :class = 'dataState.temperature === "current" ? "activeTab" : "inactiveTab"' >Current</a>
                                </li>
                                <li @click = "dataState.temperature = 'history'" >
                                    <a href="#" :class = 'dataState.temperature === "history" ? "activeTab" : "inactiveTab"' >History</a>
                                </li>
                            </ul>

                        </div>

                        <h6
                            class = "text-sm text-secondary text-gray-500 ml-2"
                        >
                            {{dataState.temperature === "current" ?   "Right now":"In the last 24 hours"}}
                        </h6>
                        <TempGauge
                            v-if = "dataState.temperature === 'current'"
                            data="30">
                        </TempGauge>
                        <LineChart
                            v-if = "dataState.temperature === 'history'"
                            title="Temperature" units="°C"
                            color="#FFA600"
                            :data = "[13,13.8,12,14.5,13,15.2,14.5]"
                        ></LineChart>
                    </div>
                    <div class = "w-1/2 card bg-white rounded-md px-2 py-1 mx-4">
                        <h3 class = "text-xl font-semibold">Humidity</h3>
                        <h6 class = "text-sm text-secondary text-gray-500">In the last 24 hours</h6>

                        <LineChart
                            title="Humidity" units="%"
                            color="#58508D"
                            :data = "[38,43,64,40,37,50,60.5]"
                        ></LineChart>
                    </div>
                </div>
                <br/>
                <hr class = 'text-gray-500'/>
                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Action</button>
                    <button @click="$emit('close-modal')" class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import LineChart from "./charts/LineChart";
import TempGauge from "./charts/TempGauge";
export default {
    name: "RoomDetails",
    components: {TempGauge, LineChart},
    props: ['room'],
    data(){
        return {
            dataState:{
                temperature : 'current',
                humidity : 'current',
                lighting: 'current',
                sound: 'lighting'
            }
        }
    }
}
</script>

<style scoped>

</style>
