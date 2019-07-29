<template>
  <div
    :style="{'backgroundColor': theme.background_color, '--stroke-color': theme.secondary_text_color}"
  >
    <div class="relative w-full" style="height: 56vw;">
      <img
        class="inset-0 absolute h-full w-full object-cover"
        :src="theme.photo"
        @load="handleLoad"
        style="transition: 500ms all ease;"
        :style="{'transform': `translateY(${isLoading ? '3px': '0'})`}"
        :class="{'opacity-0': isLoading, 'opacity-100': !isLoading}"
      />

      <div class="relative">
        <div
          ref="content"
          v-html="response.content"
          class="font-serif focus:outline-none h-full overflow-auto"
          :contenteditable="editable"
          :style="{'color': theme.primary_text_color, 'fontSize': `${fontSize}vw`, }"
          style="width: 50vw; padding:4vw; padding-top: 10vw"
        />
      </div>

      <h3
        class="absolute font-sans font-bold"
        style="bottom: 0; font-size: 2vw; padding: 4vw"
        :style="{color: theme.secondary_text_color, backgroundColor: theme.background_color}"
      >
        {{response.name}}
        <br />
        {{response.city}}
      </h3>
      <h1 class="uppercase space__name">{{space.name}}</h1>
    </div>
  </div>
</template>
<style>
.space__name {
  transform: rotate(-90deg);
  position: absolute;
  left: 96%;
  bottom: 0;
  -webkit-text-stroke: 0.15vw var(--stroke-color);
  color: transparent;
  font-size: 3vw;
  font-weight: 800;
  transform-origin: left center;
  width: 74vh;
  letter-spacing: 0.375vw;
  text-align: center;
}
</style>
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
    },
    getInnerHtml() {
      return this.$refs.content.innerHTML;
    }
  },
  computed: {
    isLoading({ state }) {
      return state === "loading";
    }
  },
  watch: {
    theme: function() {
      this.state = "loading";
    }
  },
  props: {
    editable: Boolean,
    theme: Object,
    response: Object,
    space: Object,
    fontSize: Number
  }
};
</script>

