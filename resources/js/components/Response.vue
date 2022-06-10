<template>
    <div
        class="transition"
        :style="{
            backgroundColor: theme.background_color,
            '--stroke-color': theme.secondary_text_color
        }"
        @click="emit"
    >
        <div class="relative w-full" style="height: 56vw">
            <img
                class="inset-0 absolute h-full w-full object-cover"
                :src="theme.photo"
                @load="handleLoad"
                style="transition: 300ms all ease"
                :style="{
                    transform: `translateY(${
                        isLoading || switching ? '3px' : '0'
                    })`
                }"
                :class="{ 'opacity-0': isLoading || switching }"
            />

            <div class="relative">
                <div
                    ref="content"
                    v-html="response.content"
                    class="font-serif focus:outline-none h-full overflow-auto"
                    :contenteditable="editable"
                    :style="{
                        color: theme.primary_text_color,
                        fontSize: `${fontSize}vw`,
                        transition: '300ms transform ease, 300ms color ease',
                        ...switchingStyles
                    }"
                    style="width: 75vw; padding: 4vw; padding-top: 10vw"
                />
            </div>

            <div
                class="absolute bg-white font-bold uppercase"
                style="
                    padding: 1vw;
                    transition-delay: 100ms;
                    font-size: 1vw;
                    top: 2vw;
                    left: 4vw;
                "
                :style="{
                    color: theme.secondary_text_color
                }"
                v-html="response.prompt"
            />

            <h3
                class="absolute font-sans font-bold transition"
                style="
                    bottom: 0;
                    font-size: 2vw;
                    padding: 4vw;
                    transition-delay: 100ms;
                    overflow-wrap: anywhere;
                "
                :style="{
                    color: theme.secondary_text_color,
                    ...switchingStyles
                }"
            >
                {{ response.name }}
                <br />
                {{ response.city }}
            </h3>
            <h1 class="uppercase space__name">{{ space.name }}</h1>
        </div>
    </div>
</template>
<style>
.space__name {
    transform: rotate(-90deg);
    position: absolute;
    left: 96%;
    bottom: 0;
    -webkit-text-stroke: 0.1vw var(--stroke-color);
    color: var(--stroke-color);
    font-size: 3vw;
    font-weight: 800;
    transform-origin: left center;
    width: 51vw;
    letter-spacing: 0.375vw;
    text-align: center;
}
</style>
<script>
export default {
    data() {
        return {
            state: "loading"
        };
    },
    methods: {
        handleLoad() {
            this.state = "default";
        },
        getInnerHtml() {
            return this.$refs.content.innerHTML;
        },
        emit(e) {
            this.$emit("click", e, this.response);
        }
    },
    computed: {
        isLoading({ state }) {
            return state === "loading";
        },
        switchingStyles({ switching }) {
            return {
                transform: `translateY(${switching ? 5 : 0}px)`,
                opacity: switching ? 0 : 1
            };
        }
    },
    watch: {
        theme: function() {
            this.state = "loading";
        }
    },
    props: {
        editable: Boolean,
        theme: Object,
        response: Object,
        space: Object,
        fontSize: Number,
        switching: {
            type: Boolean,
            default: false
        }
    }
};
</script>
