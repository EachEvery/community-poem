<template>
  <div>
    <img src="/img/globe-full.png" :style="rotateStyle" />
  </div>
</template>
<script>
export default {
  data() {
    return {
      scrollTop: 0
    };
  },
  methods: {
    setScroll(e) {
      this.scrollTop = document.body.scrollTop;
    }
  },
  computed: {
    rotateStyle({ scrollTop }) {
      return {
        transform: `rotate(-${scrollTop * 0.04}deg)`
      };
    }
  },
  mounted() {
    window.addEventListener("scroll", this.setScroll);
  }
};
</script>