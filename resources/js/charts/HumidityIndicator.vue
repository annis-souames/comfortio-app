<template>
    <div class="flex flex-row gap-7 items-center justify-center w-fit h-fit">
        <div class="relative">
            <img class="absolute" src="../../../water-drop-gray.webp" width="120"/>
            <img class="image" :style="cssProps" src="../../../water-drop.webp" width="120"/>
        </div>

        <h1 v-if="value != null" class="text-4xl text-blue-900 font-bold w-[6rem]">{{value}}%</h1>
    </div>
</template>

<script>
export default {
    name: "HumidityIndicator",
    components: {},
    props: [
        'value',
    ],
    data() {
        return {
            
        };
    },
    computed: {
        cssProps() {
            return {
                '--percentage': (100 - this.value) + "%",
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

</style>
