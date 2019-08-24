<template>
  <div>
    <div class="registration-form p-0 pb-100">
      <span class="addtocalendar atc-style-theme registrationPriceFloating">
        <a class="atcb-link" tabindex="1" id>{{ totalAmount }}</a>
      </span>
      <form action method="POST" target="_top" id>
        <div class="row">
          <div class="col-md-9">
            <input-text
              label="Name"
              name="name"
              placeholder="Name"
              :required="true"
              v-model="participantData.name"
            ></input-text>
          </div>

          <div class="col-md-3">
            <img
              class="pull-right img-thumbnail"
              src="https://instantglamour.com/wp-content/uploads/photo-gallery/Passport%20photo/pp-1.jpg"
              alt
            />
          </div>
        </div>

        <div
          class="row mt-15 mb-15"
          v-for="(item, keyIndex) in participantData.guests"
          :key="keyIndex"
        >
          <div class="col-md-6">
            <input-text
              label="Guest Name"
              name="Guest_name"
              placeholder="Guest Name"
              :required="true"
              v-model="item.name"
            ></input-text>
          </div>
          <div class="col-md-3">
            <input-text
              label="Relation"
              name="relation"
              placeholder="Relation"
              :required="true"
              v-model="item.relation"
            ></input-text>
          </div>
          <div class="col-md-2">
            <img
              class="pull-right img-thumbnail guest-thumbnail"
              src="https://instantglamour.com/wp-content/uploads/photo-gallery/Passport%20photo/pp-1.jpg"
              alt
            />
          </div>
          <div class="col-md-1">
            <button class="btn btn-sm bg-danger mt-30" @click.prevent="removeGuest(keyIndex)">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </div>

        <button class="btn btn-success btn-sm mb-25" @click.prevent="addGuest">Add Guest</button>

        <div class="row">
          <div class="col-md-6">
            <input-text
              label="Date Of Birth"
              name="date_of_birth"
              placeholder="Date Of Birth"
              :required="true"
              v-model="participantData.date_of_birth"
              type="date"
            ></input-text>
          </div>
          <div class="col-md-6">
            <input-text
              label="Admission Year"
              name="admission_year"
              placeholder="1985"
              :required="true"
              v-model="participantData.admission_year"
            ></input-text>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <input-text
              label="Class"
              name="class"
              placeholder="5"
              :required="true"
              v-model="participantData.class"
            ></input-text>
          </div>
          <div class="col-md-4">
            <input-text
              label="Group"
              name="group"
              placeholder="Science"
              :required="true"
              v-model="participantData.group"
            ></input-text>
          </div>
          <div class="col-md-4">
            <input-text
              label="Subject"
              name="subject"
              placeholder="H.S.C"
              :required="true"
              v-model="participantData.subject"
            ></input-text>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8">
            <input-text
              label="Address"
              name="address"
              placeholder="Address"
              :required="true"
              v-model="participantData.address"
            ></input-text>
          </div>
          <div class="col-md-4">
            <input-text
              label="City"
              name="city"
              placeholder="City"
              :required="true"
              v-model="participantData.city"
            ></input-text>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <input-text
              label="State"
              name="state"
              placeholder="State"
              :required="true"
              v-model="participantData.state"
            ></input-text>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Country</label>
              <select class="form-control" name="os0" required v-model="participantData.country">
                <option value="-1">Choose...</option>
                <option
                  v-for="(country, index) in countries"
                  :value="country"
                  :key="index"
                >{{ country }}</option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <input-text
              label="Zip Code"
              name="zip_code"
              placeholder="Zip Code"
              :required="true"
              v-model="participantData.zip_code"
            ></input-text>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <input-text
              label="Mobile No."
              name="mobile_no"
              placeholder="01711111111"
              :required="true"
              v-model="participantData.mobile_no"
            ></input-text>
          </div>

          <div class="col-md-6">
            <input-text
              label="Email"
              name="email"
              placeholder="yourmail@mail.com"
              v-model="participantData.email"
            ></input-text>
          </div>
        </div>

        <div class="row" v-if="!currentStudent">
          <div class="col-md-3">
            <input-text
              label="Occupation"
              name="occupation"
              placeholder="Occupation"
              :required="true"
              v-model="participantData.occupation"
            ></input-text>
          </div>

          <div class="col-md-3">
            <input-text
              label="Designation (Optional)"
              name="designation"
              placeholder="Designation"
              v-model="participantData.occupation_details.designation"
            ></input-text>
          </div>

          <div class="col-md-3">
            <input-text
              label="Department (Optional)"
              name="department"
              placeholder="department"
              v-model="participantData.occupation_details.department"
            ></input-text>
          </div>

          <div class="col-md-3">
            <input-text
              label="Company Name (Optional)"
              name="companty_name"
              placeholder="Company Name"
              v-model="participantData.occupation_details.companty_name"
            ></input-text>
          </div>
        </div>

        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="only_register" required /> Will Present at the event
            </label>
          </div>
        </div>

        <div class="row">
          <div class="col-md-offset-4 col-md-4">
            <div class="pricing-item highlighted-plan wow zoomIn mt-20">
              <div class="plan-name">Registration Price</div>
              <div class="price">
                <span class="curr">৳</span>
                {{ totalAmount }}
              </div>
            </div>
          </div>
        </div>

        <div class="text-center top-space">
          <button type="submit" id="reserve-btn" class="btn btn-success btn-lg">Reserve my Seat</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import inputText from "../common/form/input-text";
import { countries, registrationPrice } from "../../Constants";
export default {
  props: {
    currentStudent: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      participantData: {
        name: "",
        date_of_birth: "",
        admission_year: "",
        class: "",
        group: "",
        subject: "",
        address: "",
        city: "",
        state: "",
        country: -1,
        zip_code: "",
        mobile_no: "",
        email: "",
        occupation: "",
        occupation_details: {
          designation: "",
          department: "",
          company_name: ""
        },
        guests: [
          {
            name: "",
            relation: "",
            image: ""
          }
        ]
      },
      countries: countries
    };
  },
  components: {
    inputText
  },
  computed: {
    totalAmount() {
      return (
        registrationPrice.former_student_in_bd.self +
        this.participantData.guests.length *
          registrationPrice.former_student_in_bd.guest
      );
    }
  },
  methods: {
    addGuest() {
      this.participantData.guests.push({
        name: "",
        relation: "",
        image: ""
      });
    },
    removeGuest(index) {
      //   this.participantData.guests.splice(index, 1);
      console.log(index);
      this.$delete(this.participantData.guests, index);
    }
  }
};
</script>

<style lang="scss" scoped>
.img-thumbnail {
  width: 100px;
}
.guest-thumbnail {
  width: 100px;
}
.registrationPriceFloating {
  position: fixed;
  right: 0;
  top: 40%;
  z-index: 99;
  background: #fff !important;
}
.registrationPriceFloating a {
  font-size: 30px;
  padding: 15px 20px;
}
</style>