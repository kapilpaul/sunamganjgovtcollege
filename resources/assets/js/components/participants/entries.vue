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
              <th>Mobile No</th>
              <th>Country</th>
              <th>Paid</th>
              <th style="width: 150px;" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <!-- <td>
                <a
                  target="_blank"
                  href=""
                >{{ $participant->name }}</a>
              </td>
              <td>{{ $participant->mobile_no }}</td>
              <td>{{ $participant->country }}</td>
              <td>
                @if($participant->paid == 0)
                <p class="label label-warning">Not Paid</p>@else
                <p class="label label-success">Paid</p>@endif
              </td>-->

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
      participantsUrl: axios.defaults.baseURL + "participants"
    };
  },
  components: {
    search,
    pagination
  },
  computed: {
    participants() {
      let items = this.$store.getters.items;
      if (typeof items.participants !== "undefined") {
        let pageCount = items.participants.last_page
          ? items.participants.last_page
          : 2;
        this.$store.dispatch("setPageCount", pageCount);
      }

      return items.participants;
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