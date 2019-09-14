<template>
  <div class="fixed top-0 inset-x-0">
    <div
      class="flex justify-between flex px-8 py-4 bg-white transition z-20"
      :class="{'shadow': !open}"
    >
      <a
        href="/"
        class="text-lg uppercase text-2xl block text-green-900 font-display font-bold select-none"
      >Global Peace Poem</a>

      <clickable @click="() => setState('default')" v-if="open">
        <close-icon class="text-green-900 w-6 h-6" />
      </clickable>

      <clickable @click="() => setState('open')" v-if="!open">
        <menu-icon class="text-green-900 w-6 h-6" />
      </clickable>
    </div>

    <portal to="end-of-body">
      <div
        class="h-screen bg-white transition absolute top-0 inset-x-0 flex flex-col"
        style="padding-top: 18vh"
        :class="menuClass"
      >
        <div class="flex flex-col text-green-900">
          <a
            href="/"
            class="font-display text-5xl font-semibold uppercase self-center"
            :class="{'text-outline': currentRouteName !== 'about'}"
          >About</a>

          <a
            href="/responses"
            class="font-display text-5xl font-semibold uppercase self-center mt-5"
            :class="{'text-outline': currentRouteName !== 'responses'}"
          >Responses</a>

          <a
            href="mailto:wickpoetry@kent.edu?subject=Global Peace Poem"
            class="font-display text-5xl font-semibold uppercase self-center mt-5"
            :class="{'text-outline': true}"
          >Get in Touch</a>
        </div>

        <div class="absolute inset-x-0 bottom-0 pb-32 flex flex-col text-green-900">
          <a
            href="/contest"
            class="font-display text-3xl font-semibold uppercase self-center mb-12"
          >Contest</a>

          <div class="flex justify-center">
            <ts-logo class="w-16 h-16 mr-5"></ts-logo>
            <wick-logo class="w-16 h-16"></wick-logo>
          </div>
        </div>
      </div>
    </portal>
  </div>
</template>
<script>
import clickable from "./Clickable";
import menuIcon from "./MenuIcon";
import closeIcon from "./CloseIcon";

export default {
  props: {
    currentRouteName: String
  },
  components: {
    clickable,
    menuIcon,
    closeIcon
  },
  data() {
    return {
      state: "default"
    };
  },
  computed: {
    menuClass({ open }) {
      return {
        invisible: !open,
        "opacity-0": !open,
        "scale-down": !open
      };
    },
    open({ state }) {
      return state === "open";
    }
  },
  watch: {
    open: function(isOpen) {
      if (isOpen) {
        document.body.classList.add("overflow-y-hidden");
      } else {
        document.body.classList.remove("overflow-y-hidden");
      }
    }
  },
  methods: {
    setState(state) {
      this.state = state;
    }
  }
};
</script>