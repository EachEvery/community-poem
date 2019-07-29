<template>
  <div>
    <response
      :response="response"
      :theme="theme"
      :space="space"
      :font-size="fontSize"
      ref="response"
    />
    <div
      class="w-full bg-white hover:opacity-100 flex justify-between p-5 border-b border-grey-300"
      style="filter:grayscale(100%); top: calc(56vw - 4.5rem + ); transition: 300ms opacity-ease;min-width:1200px"
    >
      <div class="flex">
        <div class="self-center mr-10 w-24">
          🔎
          <span class="ml-2 text-lg font-light tracking-wider">{{fontSize}}</span>
        </div>

        <clickable class="mr-1 leading-none" @click="decreaseFont">➖</clickable>
        <clickable class="mr-1 leading-none" @click="increaseFont">➕</clickable>
      </div>

      <div class="flex">
        <clickable @click="() => prevIndex(responses, 'responseIndex')">👈</clickable>
        <h3 class="text-2xl font-light mx-3 uppercase">{{responseIndex + 1}} / {{responses.length}}</h3>
        <clickable @click="() => nextIndex(responses, 'responseIndex')">👉</clickable>
      </div>
      <div class="flex">
        <clickable
          class="mr-3"
          @click="() => nextIndex(space.theme_array, 'themeIndex')"
        >🎨 Cycle Theme</clickable>
        <clickable class="mr-3" @click="discard">🚫 Discard</clickable>
        <clickable @click="save">✅ Save and Publish</clickable>
      </div>
    </div>
  </div>
</template>
<script>
import response from "./Response";
import clickable from "./Clickable";
import axios from "axios";

export default {
  components: {
    response
  },
  props: {
    initResponses: Array,
    space: Object
  },
  data() {
    return {
      themeIndex: 0,
      responseIndex: 0,
      fontSize: 2.5,
      responses: this.initResponses
    };
  },
  methods: {
    async discard() {
      let answer = confirm(`🚫 Discard this response?

This action cannot be undone.`);

      if (answer) {
        await axios.delete(`/${this.space.slug}/responses/${this.response.id}`);

        this.deleteCurrentResponseLocal();
      }
    },
    deleteCurrentResponseLocal() {
      this.responses.splice(this.responseIndex, 1);

      if (this.responseIndex > this.responses.length - 1) {
        this.responseIndex = this.responses.length - 1;
      }
    },
    async save() {
      await axios.post(
        `/${this.space.slug}/responses/${this.response.id}/approve`,
        {
          response: {
            content: this.$refs.response.getInnerHtml(),
            font_size: this.fontSize
          }
        }
      );

      this.deleteCurrentResponseLocal();
    },
    decreaseFont() {
      this.fontSize = +(this.fontSize - 0.26).toFixed(2);
    },
    increaseFont() {
      this.fontSize = +(this.fontSize + 0.26).toFixed(2);
    },
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
    }
  },
  watch: {
    responseIndex: function() {
      this.fontSize = 2.5;
    },
    fontSize: function() {
      if (this.fontSize < 1) {
        this.fontSize = 1;
      }

      if (this.fontSize > 5) {
        this.fontSize = 5;
      }
    }
  },
  computed: {
    responseId({ responseIndex, responses }) {
      return responses[responseIndex].id;
    },
    response({ responseId }) {
      return this.responses.find(r => r.id === responseId);
    },
    theme({ themeIndex }) {
      return this.space.theme_array[themeIndex];
    }
  }
};
</script>
