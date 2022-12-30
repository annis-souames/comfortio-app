<template>
    <div class="flex flex-row gap-10 items-center justify-center w-fit h-fit">
        <div class="relative">
            <img class="absolute" src="../../../thermometer-gray.webp" width="80"/>
            <img class="image" :style="cssProps" src="../../../thermometer.webp" width="80"/>
        </div>

        <h1 :style="cssProps" v-if="value != null" class="text text-4xl font-bold w-[6rem]">{{value}}°C</h1>
    </div>
</template>

<script>
export default {
    name: "Thermometer",
    components: {},
    props: [
        'value',
    ],
    data() {
        return {
            
        };
    },
    computed: {
        percentage() {
            return Math.min(Math.max(parseInt(100 - (2.33 * this.value - 2.38)), 0), 100);
        },
        cssProps() {
            return {
                '--percentage': this.percentage + "%",

                '--red-col': (100 - this.percentage) + "%",
                '--green-col': (this.percentage / 2) + "%",
                '--blue-col': this.percentage + "%",
            }
        }
    }
};
</script>

<style scoped>

.image {
    -webkit-clip-path: inset(var(--percentage) 0px 0px 0px);
    clip-path: inset(var(--percentage) 0px 0px 0px);
}

.text {
    color: rgb(var(--red-col), var(--green-col), var(--blue-col));
}

</style>
