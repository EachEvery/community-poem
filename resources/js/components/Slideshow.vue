<template>
    <div
        class="h-screen w-full"
        :style="{ backgroundColor: theme.background_color }"
        @click="handleClick"
    >
        <response
            :response="response"
            :editable="false"
            :font-size="+response.font_size"
            :theme="theme"
            :space="space"
            :switching="state === 'switching'"
        />
    </div>
</template>
<script>
import response from "./Response";

export default {
    components: {
        response,
    },
    props: {
        space: Object,
        responses: Array,
        autoplay: {
            type: Boolean,
            default: true,
        },
        interval: {
            type: Number,
            default: 8,
        },
    },
    methods: {
        prevIndex(arr, prop) {
            if (this[prop] === 0) {
                this[prop] = arr.length - 1;
            } else {
                this[prop]--;
            }
        },
        nextIndex(arr, prop) {
            if (this[prop] === arr.length - 1) {
                this[prop] = 0;
            } else {
                this[prop]++;
            }
        },
        sleep(ms = 350) {
            return new Promise((resolve) => {
                setTimeout(() => {
                    resolve();
                }, 350);
            });
        },
        handleClick() {
            clearInterval(this.slideshowInterval);
            this.next();
        },
        async next() {
            this.state = "switching";

            await this.sleep(50);

            this.nextIndex(this.space.theme_array, "themeIndex");

            await this.sleep();

            this.nextIndex(this.responses, "responseIndex");

            this.state = "default";
        },
    },
    data() {
        return {
            themeIndex: 0,
            responseIndex: 0,
            state: "default",
        };
    },
    mounted() {
        if (this.autoplay) {
            this.slideshowInterval = setInterval(async () => {
                this.next();
            }, this.interval * 1000);
        } else {
            this.themeIndex = Math.floor(
                Math.random() * this.space.theme_array.length
            );

            this.responseIndex = Math.floor(
                Math.random() * this.responses.length
            );
        }
    },
    computed: {
        responseId({ responseIndex, responses }) {
            return responses[responseIndex].id;
        },
        response({ responseId }) {
            return this.responses.find((r) => r.id === responseId);
        },
        theme({ themeIndex }) {
            return this.space.theme_array[themeIndex];
        },
    },
};
</script>
