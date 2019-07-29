<template>
  <button class="p-2 text-sm rounded-lg border px-3 no-select active-shrink" @click="emit">
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