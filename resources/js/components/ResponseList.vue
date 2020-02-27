<template>
  <div>
    <h1 class="text-center font-bold mt-12">
      All Responses for
      <span class="italic">{{space.name}}</span>
      ({{responses.length}}) -
      <a
        class="text-gray-600 underline"
        :href="`/spaces/${space.slug}/slideshow`"
        target="_blank"
      >View Slideshow</a>
    </h1>

    <h3 class="text-center mt-12">🛑 Unapproved ({{unapproved.length}})</h3>

    <div class="px-24 mt-12">
      <response
        class="-mt-24 cursor-pointer"
        style="transform: scale(0.8);"
        v-for="response in unapproved"
        :key="response.id"
        :theme="randomTheme()"
        :response="response"
        :font-size="+response.font_size"
        :editable="false"
        :space="space"
        @click="handleItemClick"
      />
    </div>

    <h3 class="text-center mt-24">✅ Approved ({{approved.length}})</h3>

    <div class="px-24 mt-12 mb-24">
      <response
        class="-mt-24 cursor-pointer"
        style="transform: scale(0.8);"
        v-for="response in approved"
        :key="response.id"
        :theme="randomTheme()"
        :response="response"
        :font-size="+response.font_size"
        :editable="false"
        :space="space"
        @click="handleItemClick"
      />
    </div>
  </div>
</template>

<style lang="scss" scoped>
</style>

<script>
import response from "./Response";

export default {
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
    }
  },
  methods: {
    randomTheme() {
      let items = this.space.theme_array;

      return items[Math.floor(Math.random() * items.length)];
    },
    handleItemClick(e, item) {
      this.$emit("item-clicked", e, item);
    }
  }
};
</script>

