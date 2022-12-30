<template>
    <div @wheel.prevent @touchmove.prevent @scroll.prevent class="flex flex-col items-center jufisty-center content-center border border-black rounded-sm m-3 w-[27rem] h-[27rem] bg-white relative overflow-x-hidden no-scrollbar">
        <p class="text-xl mt-5 font-bold">
            {{title}}
        </p>

        <div class="relative h-3/4 flex items-center justify-center">
            <div class="chart1 absolute" :class='show_chart1 ? "active" : ""'>
                <slot name="chart1"></slot>
            </div>
            <div class="chart2" :class='show_chart1 ? "" : "active"'>
                <slot name="chart2"></slot>
            </div>
        </div>

        <div class="flex items-center justify-center absolute inset-x-0 bottom-0 mb-1">
            <ul class="flex flex-row font-medium text-center text-gray-500 border border-black">
                <li class="flex grow button1 py-1 px-2 w-1/2 text-md" :class = 'show_chart1 === true ? "active" : ""' @click='show_chart1 = true'>
                    <a href="#">Current</a>
                </li>
                <li class="flex grow button2 py-1 px-2 w-1/2 text-md" :class = 'show_chart1 === false ? "active" : ""' @click='show_chart1 = false'>
                    <a href="#">History</a>
                </li>
            </ul>
        </div>

    </div>
</template>

<script>
export default {
    name: "PropDetails",
    components: {},
    props: [
        'title',
    ],
    data() {
        return {
            show_chart1: true,
        };
    },
};
</script>

<style lang="scss" scoped>

.chart1 {
    transform: translateX(-500px);
    transition: 0.3s ease-in-out;

    &.active {
        transform: translateX(0);
    }
}

.chart2 {
    transform: translateX(500px);
    transition: 0.3s ease-in-out;

    &.active {
        transform: translateX(0);
    }
}

.button1 {
    color: rgb(107 114 128);
    transition: 0.3s ease-in-out;

    background: linear-gradient(to right, white 50%, rgb(59 130 246) 50%) left;
    background-size: 200%;
    transition: .3s ease-out;

    &.active{
        color: white;

        background-position: right;
    }
}

.button2 {
    color: rgb(107 114 128);
    transition: 0.3s ease-in-out;

    background: linear-gradient(to left, white 50%, rgb(59 130 246) 50%) right;
    background-size: 200%;
    transition: .3s ease-out;

    &.active{
        color: white;

        background-position: left;
    }
}

</style>

<style>
/* Hide scrollbar for Chrome, Safari and Opera */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>
