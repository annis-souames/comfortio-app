<template>
    <div class="flex flex-row gap-10 items-center justify-center w-fit h-fit">
        <div class="relative">
            <img class="absolute" src="../../../lightbulb-gray.webp" width="150"/>
            <img class="image" :style="cssProps" src="../../../lightbulb.webp" width="150"/>
        </div>

        <h1 :style="cssProps" v-if="value != null" class="text-4xl font-bold w-[6rem]">{{value}}Cd</h1>
    </div>
</template>

<script>
export default {
    name: "LightIndicator",
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
                '--percentage': Math.min(Math.max((100 - this.value), 0), 100) + "%",
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
