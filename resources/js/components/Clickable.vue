<template>
  <button
    class="p-1 text-xs rounded-lg border px-2 no-select active-shrink flex-grow-0"
    @click="emit"
  >
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
</style>