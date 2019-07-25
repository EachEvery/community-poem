<template>
  <div>
    <response :response="response" :theme="theme" />
    <div
      class="fixed top-0 inset-x-0 bg-white opacity-25 hover:opacity-100 flex justify-between p-5 border-b border-grey-300 transition"
    >
      <div class="flex">
        <h3
          class="font-sans uppercase text-base font-normal self-center mr-10 w-48"
        >Font Size: {{fontSize}}</h3>
        <clickable class="mr-1 leading-none" @click="decreaseFont">-</clickable>
        <clickable class="mr-1 leading-none" @click="increaseFont">+</clickable>
      </div>

      <div class="flex">
        <clickable class="mr-3">🚫 Discard</clickable>
        <clickable>✅ Save and Publish</clickable>
      </div>
    </div>
  </div>
</template>
<script>
import response from "./Response";
import clickable from "./Clickable";
export default {
  components: {
    response
  },
  props: {
    responses: Array,
    space: Object
  },
  data() {
    return {
      themeIndex: 0,
      responseId: this.responses[0].id,
      fontSize: 1.23
    };
  },
  methods: {
    decreaseFont() {
      this.fontSize = +(this.fontSize - 0.26).toFixed(2);
    },
    increaseFont() {
      this.fontSize = +(this.fontSize + 0.26).toFixed(2);
    }
  },
  watch: {
    fontSize: function() {
      if (this.fontSize < 0) {
        this.fontSize = 0;
      }

      if (this.fontSize > 5) {
        this.fontSize = 5;
      }
    }
  },
  computed: {
    response({ responseId }) {
      return this.respon;
    },
    theme({ themeIndex }) {
      // return {};
      return this.space.theme_array[themeIndex];
    }
  },
  mounted() {
    console.log(this.responses, this.space);
  }
};
</script>
