<template>
    <div class="modal fixed bg-opacity-0 w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-500 bg-opacity-50"></div>

        <div class="modal-container w-4/5 h-full z-50 items-center justify-center">

            <!-- Add margin if you want to see grey behind the modal-->
            <div class="modal-content bg-white container mx-auto text-left p-4">

                <!--Title-->
                <div class="flex justify-between items-center pb-2 bg-red-300">
                    <p v-if="room != null" class="text-2xl font-bold">{{room.name}} details : </p>

                    <div @click="$emit('close-modal')" class="modal-close cursor-pointer flex flex-col items-center mt-4 mr-4 text-black text-sm z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                        <!-- (Esc) -->
                    </div>
                </div>
                <hr class = "text-gray-500"/>

                <!--Body-->
                <div class = "grid grid-cols-2 gap-5 w-full place-items-center justify-center bg-gray-100 mt-3 overflow-y-scroll">

                    <div class="flex flex-col items-center justify-center w-fit mt-2 bg-purple-300">

                        <div class = "flex flex-col card w-full rounded-md items-center justify-center bg-gray-400">
                            <div class = "card-header w-full flex flex-col items-center justify-center bg-blue-400">
                                <h3 class = "text-xl font-semibold ml-2">
                                    Temperature
                                </h3>
                                <h6 class = "text-sm text-secondary text-gray-500">
                                    {{dataState.temperature === "current" ? "Right now" : "In the last 24 hours"}}
                                </h6>
                            </div>

                            <div class="flex items-center justify-center bg-pink-500 w-full h-fit">
                                <TempGauge
                                    v-if = "dataState.temperature === 'current'"
                                    data="30"
                                >
                                </TempGauge>

                                <LineChart
                                    v-if = "dataState.temperature === 'history'"
                                    title="Temperature" units="°C"
                                    color="#FFA600"
                                    :data="[13,13.8,12,14.5,13,15.2,14.5]"
                                ></LineChart>
                            </div>
                        </div>

                        <div class="flex items-center justify-center">
                            <ul class="flex flex-wrap gap-5 font-medium text-center text-gray-500 mb-2">
                                <li class="mr-2" @click = 'dataState.temperature = "current"'>
                                    <a href="#" :class = 'dataState.temperature === "current" ? "text-blue-500 underline text-md" : "text-gray-500 text-md hover:underline"' >Current</a>
                                </li>
                                <li @click = "dataState.temperature = 'history'" >
                                    <a href="#" :class = 'dataState.temperature === "history" ? "text-blue-500 underline text-md" : "text-gray-500 text-md hover:underline"' >History</a>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="flex flex-col items-center justify-center w-fit mt-2 bg-yellow-300">

                        <div class = "flex flex-col card w-full rounded-md items-center justify-center bg-gray-400">
                            <div class = "card-header w-full flex flex-col items-center justify-center bg-blue-400">
                                <h3 class = "text-xl font-semibold ml-2">
                                    Temperature
                                </h3>
                                <h6 class = "text-sm text-secondary text-gray-500">
                                    {{dataState.temperature === "current" ? "Right now" : "In the last 24 hours"}}
                                </h6>
                            </div>

                            <div class="flex items-center justify-center bg-pink-500 w-full">
                                <TempGauge
                                    v-if = "dataState.temperature === 'current'"
                                    data="30">
                                </TempGauge>

                                <LineChart
                                    v-if = "dataState.temperature === 'history'"
                                    title="Temperature" units="°C"
                                    color="#FFA600"
                                    :data="[13,13.8,12,14.5,13,15.2,14.5]"
                                ></LineChart>
                            </div>
                        </div>

                        <div class="flex items-center justify-center">
                            <ul class="flex flex-wrap gap-5 font-medium text-center text-gray-500 mb-2">
                                <li class="mr-2" @click = 'dataState.temperature = "current"'>
                                    <a href="#" :class = 'dataState.temperature === "current" ? "text-blue-500 underline text-md" : "text-gray-500 text-md hover:underline"' >Current</a>
                                </li>
                                <li @click = "dataState.temperature = 'history'" >
                                    <a href="#" :class = 'dataState.temperature === "history" ? "text-blue-500 underline text-md" : "text-gray-500 text-md hover:underline"' >History</a>
                                </li>
                            </ul>
                        </div>

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
                <div class="flex justify-end pt-2 pb-2 bg-green-500">
                    <button @click="$emit('close-modal')" class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Close</button>
                    <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Action</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import LineChart from "./charts/LineChart.vue";
import TempGauge from "./charts/TempGauge.vue";
export default {
    name: "RoomDetails",
    components: {TempGauge, LineChart},
    props: ['room'],
    data() {
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
