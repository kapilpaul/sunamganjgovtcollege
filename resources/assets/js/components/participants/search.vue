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
    this.fetchParticipants();
  },
  methods: {
    fetchParticipants() {
      let url = "participants";
      let headerData = this.$store.getters.getHeader;

      axios.get(url, headerData).then(response => {
        this.$store.dispatch("setParticipants", response.data);
      });
    },
    searchFilter() {
        let data = this.$store.getters.Participants;

      if (this.search !== "") {
        let searchText = this.search.toLowerCase();

        let filteredData = data.filter(item => {
          if (
            item.name.toLowerCase().match(searchText) ||
            item.alias_id.toLowerCase().match(searchText) ||
            item.uid.toLowerCase().match(searchText) ||
            item.email.toLowerCase().match(searchText) ||
            item.mobile_no.toLowerCase().match(searchText)
          ) {
            return item;
          }
        });

        this.$store.dispatch("setItems", { data: filteredData });
      } else {
        this.$store.dispatch("setItems", { data: data });
      }
    }
  }
};
</script>

<style lang="scss" scoped>
</style>