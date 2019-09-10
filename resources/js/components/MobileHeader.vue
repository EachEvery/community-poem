<template>
  <div class="fixed top-0 inset-x-0 px-8 py-4 bg-white shadow justify-between flex">
    <a
      href="/"
      class="text-lg uppercase text-3xl block text-green-900 font-display font-bold"
    >Global Peace Poem</a>

    <clickable>
      <menu-icon class="text-green-900 w-6 h-6" />
    </clickable>
  </div>
</template>
<script>
import clickable from "./Clickable";
import menuIcon from "./MenuIcon";

export default {
  components: {
    clickable,
    menuIcon
  },
  data() {
    return {
      state: "default"
    };
  }
};
</script>