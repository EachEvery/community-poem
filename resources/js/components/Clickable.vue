<template>
  <button class="p-2 text-sm rounded bg-gray-800 text-gray-300 px-3 no-select" @click="emit">
    <slot />
  </button>
</template>
<script>
export default {
  methods: {
    emit(e) {
      this.$emit("click", e);
    }
  }
};
</script>
<style scoped>
button {
  transition: 300ms all ease;
}
button:active {
  transform: scale(0.95);
}
</style>