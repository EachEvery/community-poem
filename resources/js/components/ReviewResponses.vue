<template>
  <div>
    <response
      v-if="responses.length > 0"
      :response="response"
      :theme="theme"
      :space="space"
      :editable="true"
      :font-size="+fontSize"
      ref="response"
    />
    <div
      class="w-full bg-white hover:opacity-100 flex justify-between p-5 border-b border-grey-300"
      style="top: calc(56vw - 4.5rem + ); transition: 300ms opacity-ease;min-width:1200px"
    >
      <div v-if="responses.length > 0" class="flex relative">
        <div class="flex" style="transform: scale(.7)">
          <clickable @click="() => prevIndex(responses, 'responseIndex')">👈</clickable>
          <h3
            class="w-24 text-2xl font-mono mx-3 uppercase text-center"
          >{{responseIndex + 1}}/{{responses.length}}</h3>
          <clickable @click="() => nextIndex(responses, 'responseIndex')">👉</clickable>
        </div>

        <h3
          class="text-xs text-center self-center uppercase"
          style="width: 10rem"
          :class="{'text-green-600': response.status === 'approved'}"
        >Status: {{response.status}}</h3>
      </div>

      <h3
        class="self-center uppercase"
        v-if="responses.length === 0"
      >No {{selectedStatus}} Responses</h3>

      <div class="flex mx-12">
        <div class="self-center mr-3" style="width: 5rem">
          🔎
          <span class="ml-2 text-sm font-light tracking-wider">{{fontSize}}</span>
        </div>

        <div class="flex" style="transform: scale(.7)">
          <clickable class="mr-1 leading-none" @click="decreaseFont">➖</clickable>
          <clickable class="mr-1 leading-none" @click="increaseFont">➕</clickable>
        </div>
      </div>

      <div class="flex flex-grow justify-end">
        <clickable class="mr-3" @click="discard" v-if="response.status === 'unapproved'">🚫 Discard</clickable>
        <clickable
          v-if="response.status === 'approved'"
          @click="(e) => save(e, true)"
          class="mr-3"
        >♻️ Update</clickable>

        <clickable
          class="mr-3"
          @click="() => nextIndex(space.theme_array, 'themeIndex')"
        >🎨 Cycle Theme</clickable>

        <clickable
          class="mr-3"
          @click="unapprove"
          v-if="response.status === 'approved'"
        >🛑 Unapprove</clickable>
        <clickable v-if="response.status === 'unapproved'" @click="(e) => save(e, false)">✅ Approve</clickable>
      </div>
    </div>

    <response-list
      :responses="responses"
      :space="space"
      :active-response="response"
      @item-clicked="selectResponse"
    />
  </div>
</template>
<script>
import response from "./Response";
import clickable from "./Clickable";
import responseList from "./ResponseList";
import axios from "axios";

export default {
  components: {
    response
  },
  props: {
    initResponses: Array,
    space: Object
  },
  data() {
    let res = this.initResponses.map(item => {
      return {
        ...item,
        font_size: item.font_size === null ? 2.5 : item.font_size
      };
    });

    return {
      themeIndex: 0,
      responseIndex: 0,
      fontSize: this.initResponses.length === 0 ? 2.5 : res[0].font_size,
      responses: res,
      selectedStatus: "approved"
    };
  },
  methods: {
    handleKeyDown({ keyCode }) {
      if (keyCode === 39) {
        this.nextIndex(this.responses, "responseIndex");
      }

      if (keyCode === 37) {
        this.prevIndex(this.responses, "responseIndex");
      }
    },
    selectResponse(e, response) {
      this.selectedStatus = response.status;

      this.responseIndex = this.responses.findIndex(i => i.id === response.id);

      document.body.scrollTop = 0; // For Safari
      document.documentElement.scrollTop = 0;
    },

    async discard() {
      let answer = confirm(`🚫 Discard this response?

This action cannot be undone.`);

      if (answer) {
        await axios.delete(
          `/spaces/${this.space.slug}/responses/${this.response.id}`
        );

        this.deleteCurrentResponseLocal();
      }
    },
    deleteCurrentResponseLocal() {
      this.responses.splice(this.responseIndex, 1);

      if (this.responseIndex > this.responses.length - 1) {
        this.responseIndex = this.responses.length - 1;
      }
    },
    async save(e, showConfirm = false) {
      let { data } = await axios.post(
        `/spaces/${this.space.slug}/responses/${this.response.id}/approve`,
        {
          response: {
            content: this.$refs.response.getInnerHtml(),
            font_size: this.fontSize
          }
        }
      );

      let response = data;
      let index = this.responses.findIndex(r => +r.id === +response.id);

      this.responses.splice(index, 1, response);

      if (showConfirm) {
        alert(`♻️ Successfully Updated Response`);
      } else {
        this.nextIndex(this.responses, "responseIndex");
      }
    },
    async unapprove() {
      let { data } = await axios.post(
        `/spaces/${this.space.slug}/responses/${this.response.id}/approve`,
        {
          response: {
            approved_at: null
          }
        }
      );

      let response = data;

      let index = this.responses.findIndex(r => +r.id === +response.id);

      this.responses.splice(index, 1, response);
    },
    decreaseFont() {
      this.fontSize = +(this.fontSize - 0.26).toFixed(2);
    },
    increaseFont() {
      this.fontSize = +(this.fontSize + 0.26).toFixed(2);
    },
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
    },
    ensureFontSize() {
      if (this.fontSize < 1) {
        this.fontSize = 1;
      }

      if (this.fontSize > 5) {
        this.fontSize = 5;
      }
    }
  },
  watch: {
    responseIndex: function() {
      this.fontSize = +this.response.font_size;
    },
    fontSize: function() {
      this.ensureFontSize();
    }
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
  },
  destroyed() {
    document.removeEventListener("keydown", this.handleKeyDown);
  },

  mounted() {
    this.ensureFontSize();
    document.addEventListener("keydown", this.handleKeyDown);
  }
};
</script>
