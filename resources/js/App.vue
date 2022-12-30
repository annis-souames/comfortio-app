<script>
import Floorplan from './Floorplan.vue'
import RoomDetails from "./RoomDetails.vue";
import RoomDetails2 from "./RoomDetails2.vue";
export default {
    components: {RoomDetails, RoomDetails2, Floorplan},
    data() {
        return {
            count: 0,
            rooms : [
                {
                    id: 1,
                    name: 'Room 110',
                    data: []
                },
                {
                    id: 2,
                    name: 'Room 111',
                    data: []
                },
                {
                    id: 3,
                    name: 'Room 112',
                    data: []
                },
                {
                    id: 4,
                    name: 'Room 113',
                    data: []
                },
                {
                    id: 5,
                    name: 'Hallway',
                    data: []
                },
                {
                    id: 6,
                    name: 'Room 108',
                    data: []
                },
                {
                    id: 7,
                    name: 'Room 114',
                    data: []
                }
            ],
            selectedRoom: null,
            showFilterMenu: false,
            showRoomDetails: false,
            best_room_id: 2,
        }
    },
    methods:{
        setSelectedRoom(payload) {
            this.selectedRoom = this.rooms.filter(room => {
                return room.id === payload.id
            })[0]
            this.showRoomDetails = true
        },
    }
}
</script>

<template>
    <div class = "w-full flex justify-content-evenly bg-white">
        <aside class="w-64 mr-6" aria-label="Sidebar" v-bind:class="{'reveal-menu':showFilterMenu, 'hide-menu': (showFilterMenu == false)}">
            <div class="h-full py-4 px-3 bg-gray-50 rounded">
                <ul class="space-y-2">
                    <li>
                        <label for="steps-range" class="block mb-2 text-sm font-bold text-gray-900">Temperature</label>
                        <input id="steps-range" type="range" min="0" max="5" value="2.5" step="0.5" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                    </li>
                    <li>
                        <label for="steps-range" class="block mb-2 text-sm font-bold text-gray-900">Humidity</label>
                        <input id="steps-range" type="range" min="0" max="5" value="2.5" step="0.5" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                    </li>
                    <li>
                        <label for="steps-range" class="block mb-2 text-sm font-bold text-gray-900">Luminosity</label>
                        <input id="steps-range" type="range" min="0" max="5" value="2.5" step="0.5" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                    </li>
                    <li>
                        <label for="steps-range" class="block mb-2 text-sm font-bold text-gray-900">Other parameter</label>
                        <input id="steps-range" type="range" min="0" max="5" value="2.5" step="0.5" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                    </li>

                </ul>
                <div class ='flex w-full align-items-center justify-center'>
                    <button class = " mx-2 bg-blue-500 w-full hover:bg-blue-700 h-10 text-white font-bold px-5 m-2 rounded">
                        Apply
                    </button>
                </div>

            </div>
        </aside>
        <div class = 'px-6 w-full space-y-2 content' v-bind:class="{'container-push':showFilterMenu, 'container-push-back': (showFilterMenu == false)}">

            <div class = "flex w-full inline-flex  justify-between">
                <h2 class = "text-2xl py-3 font-bold"> Best room : </h2>
                <div class = 'actions  flex inline-flex align-items-end'>
                    <button class = "bg-blue-500 hover:bg-blue-700 h-10 text-white font-bold px-5 m-2 rounded" @click = "showFilterMenu= !showFilterMenu ">
                        {{
                            showFilterMenu ? 'Hide filters' : 'Filter'
                        }}
                    </button>
                    <button class = "bg-blue-500 hover:bg-blue-700 h-10 text-white font-bold px-5 m-2 rounded">
                        Export
                    </button>
                </div>
            </div>
            <input type="number" min="1" max="7" v-model="best_room_id"/>
            <div class = "flex justify-center align-items-center">
                <Floorplan 
                    v-on:select-room="setSelectedRoom"
                    :best_room_id="best_room_id"
                />
            </div>
        <RoomDetails2
            :room = "selectedRoom"
            :show = "showRoomDetails"
            v-on:close-modal = "showRoomDetails = false"
        ></RoomDetails2>
        </div>

    </div>

</template>
<style scoped>

.slide-leave-active,
.slide-enter-active {
    transition: transform 0.4s ease-in-out;
}

.slide-enter-from,.slide-leave-to{
    transform: translate(-100%);
}

.slide-enter-to,.slide-leave-from {
    transform: translate(0%);
}

aside{
    height: 100vh;
    transition: width 0.4s ease-in-out;
}

.reveal-menu{
    width: 16rem;
}

.hide-menu{
    overflow: hidden;
    white-space: nowrap;
    width: 0rem;
}


</style>
