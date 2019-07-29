<template>
  <div class="h-screen w-full" :style="{backgroundColor: theme.background_color}">
    <response
      :response="response"
      :editable="false"
      :font-size="+response.font_size"
      :theme="theme"
      :space="space"
    />
  </div>
</template>
<script>
import response from "./Response";

export default {
  components: {
    response
  },
  props: {
    space: Object,
    responses: Array
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
    }
  },
  data() {
    return {
      themeIndex: 0,
      responseIndex: 0
    };
  },
  mounted() {
    setInterval(() => {
      this.nextIndex(this.responses, "responseIndex");
      this.nextIndex(this.space.theme_array, "themeIndex");
    }, 8000);
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

