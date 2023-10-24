<template>
  <div class="flex gap-3">
    <button
      v-for="(config, endpoint) in endpoints"
      v-bind:key="origin"
      type="button"
      class="btn"
      @click="clear(config.origin)"
    >
      Clear {{ endpoint }}
    </button>
  </div>
</template>

<script>
export default {
  props: {
    endpoints: {
      type: Array,
      required: true,
    },
  },

  methods: {
    clear(origin) {
      this.$axios
        .get(cp_url("fixel/purge-do-cdn-cache/cdns/" + origin))
        .catch((error) => {
          this.$toast.error("There was an error");
        })
        .then((response) => {
          this.$toast.success("Clearing cache for " + origin);
        });
    },
  },
};
</script>
