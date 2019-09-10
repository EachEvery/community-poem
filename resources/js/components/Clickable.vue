<template>
  <button class="no-select active-shrink" @click="emit">
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