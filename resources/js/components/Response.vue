<template>
    <div
        class="transition"
        :style="{
            backgroundColor: theme.background_color,
            '--stroke-color': theme.secondary_text_color
        }"
        @click="emit"
    >
        <div
            class="relative w-full"
            :style="{ height: (orientation && orientation == 'portait' ? ((100/9) * 16) + 'vw' : '56vw')  }"
        >
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
                        fontSize: calcValue(fontSize),
                        padding: calcValue(4),
                        paddingTop: calcValue(10),
                        transition: '300ms transform ease, 300ms color ease',
                        ...switchingStyles
                    }"
                    style="width: 75vw;"
                />
            </div>

            <div
                class="absolute font-bold uppercase"
                style="transition-delay: 100ms;"
                :style="{
                    color: theme.hasOwnProperty('block_text_color') ? theme.block_text_color : theme.secondary_text_color,
                    backgroundColor: theme.hasOwnProperty('block_color') ? theme.block_color : '#ffffff',
                    fontSize : calcValue(1),
                    padding: calcValue(1),
                    top: calcValue(2),
                    left: calcValue(4)
                }"
                v-html="response.prompt"
            />

            <h3
                class="absolute font-sans font-bold transition"
                style="
                    bottom: 0;
                    transition-delay: 100ms;
                    overflow-wrap: anywhere;
                "
                :style="{
                    color: theme.secondary_text_color,
                    fontSize: calcValue(2),
                    padding: calcValue(4),
                    ...switchingStyles
                }"
            >
                {{ response.name }}
                <br />
                {{ response.city }}
            </h3>
            <h1
                class="uppercase space__name"
                style=""
                :style="{
                    fontSize: calcValue(3),
                    letterSpacing: calcValue(0.375),
                    '-webkit-text-stroke': `${calcValue(0.1)} var(--stroke-color)`
                }"
            >{{ space.name }}</h1>
        </div>
    </div>
</template>
<style>
.space__name {
    transform: rotate(-90deg);
    position: absolute;
    left: 96%;
    bottom: 0;
    color: var(--stroke-color);
    font-weight: 800;
    transform-origin: left center;
    width: 51vw;
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
        },
        calcValue(o) {
            return this.orientation && this.orientation == 'portait' ? `${o}vh` : `${o}vw`;
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
        },

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
        },
        orientation: {
            type: String,
            required: false
        }
    }
};
</script>
