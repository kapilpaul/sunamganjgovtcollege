<template>
  <div class="row">
    <div class="col-md-12">
      <input
        type="text"
        class="form-control input-lg mb-20"
        placeholder="Search"
        v-model="search"
        @input="searchFilter()"
      />
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      search: ""
    };
  },
  mounted() {
    // this.fetchParticipants();
  },
  methods: {
    fetchParticipants() {
      let url = "";
      let headerData = this.$store.getters.getHeader;

      axios.get(url, headerData).then(response => {
        this.$store.dispatch("setParticipants", response.data);
      });
    },
    searchFilter() {
      let data = this.$store.getters.Participants;

      data.filter(item => {
        return item;
      });
    }
  }
};
</script>

<style lang="scss" scoped>
</style>