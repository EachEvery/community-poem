<template>
  <div :class="{'opacity-0': isLoading}" style="transition: 500ms all ease;">
    <div class="relative">
      <img class="inset-0 absolute" :src="theme.photo" @load="handleLoad" />
    </div>
  </div>
</template>
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
    }
  },
  computed: {
    isLoading({ state }) {
      return state === "loading";
    }
  },
  props: {
    editable: Boolean,
    theme: Object
  }
};
</script>

