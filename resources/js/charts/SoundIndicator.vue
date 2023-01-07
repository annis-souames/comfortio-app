<template>
    <div class="flex flex-row gap-5 items-center justify-center w-fit h-fit">
        <div class="relative">
            <img class="absolute" src="../../../speaker-gray.webp" width="200"/>
            <img class="image" :style="cssProps" src="../../../speaker.webp" width="200"/>
        </div>

        <h1 :style="cssProps" v-if="value != null" class="text-4xl font-bold w-[6rem]">{{value}}Db</h1>
    </div>
</template>

<script>
export default {
    name: "SoundIndicator",
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
    -webkit-clip-path: inset(0px var(--percentage) 0px 0px);
    clip-path: inset(0px var(--percentage) 0px 0px);
}

</style>
