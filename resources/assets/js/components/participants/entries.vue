<template>
  <div>
    <search></search>

    <div class="block">
      <div class="table-responsive">
        <table class="table table-vcenter table-striped">
          <thead>
            <tr>
              <th style="width: 20px;" class="text-center">#</th>
              <th>Name</th>
              <th>Guests</th>
              <th>Mobile No</th>
              <th>Paid</th>
              <th style="width: 150px;" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(participant, index) in participants" :key="participant.id">
              <td>{{ index + 1 }}</td>
              <td>
                <a target="_blank" href>{{ participant.name }}</a>
              </td>
              <td>{{ participant.guests.length }}</td>
              <td>{{ participant.mobile_no }}</td>
              <td>
                <p class="label label-warning" v-if="participant.paid === 0">Not Paid</p>
                <p class="label label-success" v-if="participant.paid === 1">Paid</p>
              </td>
              <td class="text-center">
                <div class="btn-group btn-group-xs">
                  <a
                    target="_blank"
                    href
                    data-toggle="tooltip"
                    title
                    class="btn btn-default"
                    data-original-title="Show"
                  >
                    <i class="fa fa-eye"></i>
                  </a>

                  <a
                    href="javascript:void(0)"
                    data-toggle="tooltip"
                    title
                    class="btn btn-default"
                    data-original-title="Edit"
                  >
                    <i class="fa fa-pencil"></i>
                  </a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <pagination setLocation="setItems" :url="participantsUrl + '?page='"></pagination>
      </div>
    </div>
  </div>
</template>

<script>
import search from "./search";
import pagination from "../common/pagination";
export default {
  data() {
    return {
      items: [],
      participantsUrl: axios.defaults.baseURL + "participants/paginate"
    };
  },
  components: {
    search,
    pagination
  },
  computed: {
    participants() {
      let items = this.$store.getters.items;

      if (typeof items !== "undefined") {
        let pageCount = items.last_page ? items.last_page : 1;
        this.$store.dispatch("setPageCount", pageCount);
      }

      return items.data;
    }
  },
  mounted() {
    this.getItems();
  },
  methods: {
    getItems() {
      this.$store.dispatch("setItems", { url: this.participantsUrl });
    }
  }
};
</script>

<style lang="scss" scoped>
</style>