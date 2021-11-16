<template>
    <div>
        <h1 class="text-center font-bold mt-12">
            All Responses for
            <span class="italic">{{ space.name }}</span>
            ({{ responses.length }}) -
            <a
                class="text-gray-600 underline"
                :href="`/spaces/${space.slug}/slideshow`"
                target="_blank"
                >View Slideshow</a
            >
        </h1>

        <h3 class="text-center mt-12">
            🛑 Unapproved ({{ unapproved.length }})
        </h3>

        <div class="px-24 mt-12">
            <response
                class="-mt-24 cursor-pointer"
                style="transform: scale(0.8);"
                v-for="response in unapproved.slice(0, unapprovedIndex)"
                :key="response.id"
                :theme="randomTheme()"
                :response="response"
                :font-size="+response.font_size"
                :editable="false"
                :space="space"
                @click="handleItemClick"
            />

            <div
                class="w-full text-center"
                v-bind:class="{ hidden: hideUnapprovedShowMore }"
            >
                <button class="underline" v-on:click="incUnapprovedIndex">
                    Show More
                </button>
            </div>
        </div>

        <h3 class="text-center mt-24">✅ Approved ({{ approved.length }})</h3>

        <div class="px-24 mt-12 mb-24">
            <response
                class="-mt-24 cursor-pointer"
                style="transform: scale(0.8);"
                v-for="response in approved.slice(0, approvedIndex)"
                :key="response.id"
                :theme="randomTheme()"
                :response="response"
                :font-size="+response.font_size"
                :editable="false"
                :space="space"
                @click="handleItemClick"
            />

            <div
                class="w-full text-center"
                v-bind:class="{ hidden: hideApprovedShowMore }"
            >
                <button class="underline" v-on:click="incApprovedIndex">
                    Show More
                </button>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>

<script>
import response from "./Response";

export default {
    data() {
        return {
            size: 250,
            approvedIndex: 25,
            unapprovedIndex: 25
        };
    },
    components: {
        response
    },
    props: {
        responses: Array,
        activeResponse: Object,
        space: Object
    },
    computed: {
        approved({ responses }) {
            return responses.filter(item => item.status === "approved");
        },
        unapproved({ responses }) {
            return responses.filter(item => item.status === "unapproved");
        },
        hideApprovedShowMore() {
            return this.approvedIndex >= this.approved.length;
        },
        hideUnapprovedShowMore() {
            return this.unapprovedIndex >= this.unapproved.length;
        }
    },
    methods: {
        randomTheme() {
            let items = this.space.theme_array;

            return items[Math.floor(Math.random() * items.length)];
        },
        handleItemClick(e, item) {
            this.$emit("item-clicked", e, item);
        },
        incUnapprovedIndex() {
            if (this.unapproved.length > this.unapprovedIndex + 1)
                this.unapprovedIndex += this.size;
        },
        incApprovedIndex() {
            if (this.approved.length > this.approvedIndex + 1)
                this.approvedIndex += this.size;
        }
    }
};
</script>
