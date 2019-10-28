<template>
  <div>
    <p class="text-center fz-25 mb-30">Register For</p>

    <div class="loader text-center pb-30" v-if="loader">
      <i class="fa fa-spinner fa-spin fa-3x"></i>
    </div>

    <div class="row mb-20" v-if="registerFor === ''">
      <div class="col-md-6">
        <button
          class="btn btn-lg btn-success btn-block"
          @click.prevent="registerFor = 'participate'"
        >
          Participate
        </button>
      </div>
      <div class="col-md-6">
        <button
          class="btn btn-lg btn-success btn-block"
          @click.prevent="registerFor = 'magazine'"
        >
          Magazine
        </button>
      </div>
    </div>

    <div class="row mb-20" v-if="registerFor !== '' && studentType === ''">
      <div :class="addClass">
        <button
          class="btn btn-lg btn-success btn-block"
          @click.prevent="studentType = 'former'"
        >
          Former Student
        </button>
      </div>

      <div :class="addClass">
        <button
          v-if="registerFor === 'participate'"
          class="btn btn-lg btn-success btn-block"
          @click.prevent="studentType = 'current'"
        >
          Current Student
        </button>
      </div>
    </div>

    <div class="row" v-if="studentType === 'former'">
      <div class="col-md-6">
        <button
          class="btn btn-lg btn-success btn-block"
          @click.prevent="nrb = true"
        >
          Immigrant
        </button>
      </div>
      <div class="col-md-6">
        <button
          class="btn btn-lg btn-success btn-block"
          @click.prevent="nrb = false"
        >
          Native
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "reserve-seat",
  data() {
    return {
      registerFor: "",
      studentType: "",
      nrb: "",
      addClass: "col-md-12",
      url: process.env.MIX_APP_ROOT,
      loader: false
    };
  },
  watch: {
    registerFor(value) {
      if (value === "participate") {
        this.addClass = "col-md-6";
      } else {
        this.addClass = "col-md-12";
      }
    },
    studentType(value) {
      if (this.studentType === "current") {
        this.loader = true;

        window.location = this.url + "/register/current-student";
      }
    },
    nrb(value) {
      this.loader = true;

      let param = "";
      if (this.registerFor === "magazine" && this.studentType === "former") {
        param = "?registeronly=true";
      }

      if (value) {
        window.location = this.url + "/register/nrb-former-student" + param;
      } else {
        window.location = this.url + "/register/former-student" + param;
      }
    }
  },
  methods: {},
  deactivated() {
    this.registerFor = "";
    this.studentType = "";
    this.nrb = "";
    this.addClass = "col-md-12";
  }
};
</script>

<style scoped></style>
