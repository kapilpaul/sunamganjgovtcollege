<template>
  <div>
    <div class="registration-form p-0 pb-100">
      <errors></errors>

      <span class="addtocalendar atc-style-theme registrationPriceFloating">
        <a class="atcb-link" tabindex="1" id>{{moneySymbol}} {{ totalAmount }}</a>
      </span>

      <div class="row">
        <div class="loader_area text-center" v-if="loading">
          <div class="loader">
            <i class="fa fa-spinner fa-spin fa-5x fa-fw"></i>
            <span class="sr-only">Loading...</span>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label>Title</label>
            <select class="form-control" name="os0" required v-model="participantData.title">
              <option value="Mr.">Mr.</option>
              <option value="Mrs.">Mrs.</option>
              <option value="Ms.">Ms.</option>
            </select>
          </div>
        </div>
        <div class="col-md-10">
          <input-text
            label="Full Name"
            name="name"
            placeholder="Name"
            :required="true"
            v-model="participantData.name"
          ></input-text>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="col-md-12 ml-0 pl-0">Upload Image</label>
            <small class="col-md-12 ml-0 pl-0 text-muted d-block mb-10">
              Read the photograph instructions
              <a target="_blank" :href="imageRulesUrl">here</a>
            </small>

            <div class="col-md-12 pl-0">
              <image-upload v-model="participantData.image"></image-upload>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Year Of Birth</label>
            <select
              class="form-control"
              name="os0"
              required
              v-model="participantData.year_of_birth"
            >
              <option value="-1">Select Year</option>
              <option
                v-for="(n, keyIn) in 140"
                :value="keyIn + 1880"
                :key="keyIn"
              >{{ keyIn + 1880 }}</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Year of Admission</label>
            <select
              class="form-control"
              name="os0"
              required
              v-model="participantData.admission_year"
            >
              <option value="-1">Select Year</option>
              <option v-for="(n, keyIn) in 70" :value="keyIn + 1944" :key="keyIn">{{ keyIn + 1944 }}</option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Class of Admission</label>
            <select class="form-control" name="os0" required v-model="participantData.class">
              <option value="-1">Select Class</option>
              <option v-for="(item, classIn) in classes" :value="item" :key="classIn">{{ item }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Group</label>
            <select class="form-control" name="os0" required v-model="participantData.group">
              <option value="-1">Select Group</option>
              <option value="Science">Science</option>
              <option value="Arts">Arts</option>
              <option value="Commerce">Commerce</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <input-text
            label="Subject"
            name="subject"
            :required="true"
            v-model="participantData.subject"
          ></input-text>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <input-text
            label="Mobile No. (Optional) (with country code)"
            name="mobile_no"
            placeholder="+8801711111111"
            :required="true"
            v-model="participantData.mobile_no"
            helptext="Please DONOT write your main mobile number (If you wirte It may disrupts your daily life, unwanted call can disturb you."
          ></input-text>
        </div>

        <div class="col-md-6">
          <input-text
            label="Email"
            name="email"
            placeholder="yourmail@mail.com"
            v-model="participantData.email"
            helptext="Please use donot use you main mail id, use other mail id (If you wirte It may disrupts your daily life, unwanted call can disturb you."
          ></input-text>
        </div>
      </div>

      <div class="row" v-if="!currentStudent">
        <div class="col-md-3">
          <div class="form-group">
            <label>Occupation</label>
            <select class="form-control" name="os0" required v-model="participantData.occupation">
              <option value="-1">Choose...</option>
              <option
                v-for="(occupation, occupationIn) in occupations"
                :value="occupation"
                :key="occupationIn"
              >{{ occupation }}</option>
            </select>
          </div>
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
            name="company_name"
            placeholder="Company Name"
            v-model="participantData.occupation_details.company_name"
          ></input-text>
        </div>

        <div class="col-md-12" v-if="participantData.occupation === 'Others'">
          <input-text
            label="Occupation Name"
            name="occupation_name"
            placeholder="Occupation Name"
            v-model="participantData.occupation_details.occupation_name"
          ></input-text>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8">
          <input-text
            label="Address (where you live in as a resident)"
            name="address"
            placeholder="Village, Town"
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

      <div v-if="!registerOnly">
        <h6>Possible Accompanies</h6>
        <div
          class="row mt-15 mb-15"
          v-for="(item, keyIndex) in participantData.guests"
          :key="componentKey+keyIndex"
        >
          <div class="col-md-4">
            <input-text
              label="Guest Name"
              name="Guest_name"
              placeholder="Guest Name"
              :required="true"
              v-model="item.name"
              :value="item.name"
            ></input-text>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>Relation</label>
              <select class="form-control" name="relation" required v-model="item.relation">
                <option value="-1">Choose...</option>
                <option
                  v-for="(relation, index) in relations"
                  :value="relation"
                  :key="index"
                >{{ relation }}</option>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <input-text
              label="Age"
              name="age"
              placeholder="Age"
              :required="true"
              :value="item.age"
              v-model="item.age"
            ></input-text>
          </div>
          <div class="col-md-2">
            <image-upload v-model="item.image"></image-upload>
          </div>
          <div class="col-md-1">
            <button class="btn btn-sm bg-danger mt-30" @click.prevent="removeGuest(keyIndex)">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </div>

        <button class="btn btn-success btn-sm mb-25" @click.prevent="addGuest">Add Guest</button>
      </div>

      <div class="row">
        <div class="col-md-offset-4 col-md-4">
          <div class="pricing-item highlighted-plan wow zoomIn mt-20">
            <div class="plan-name">Registration Price</div>
            <div class="price">
              <span class="curr">{{ moneySymbol }}</span>
              {{ totalAmount }}
            </div>
          </div>
        </div>
      </div>

      <div class="text-center top-space">
        <button
          id="reserve-btn"
          class="btn btn-success btn-lg"
          @click.prevent="submit"
        >Reserve my Seat</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import errors from "../common/errors";
import inputText from "../common/form/input-text";
import imageUpload from "../common/upload/image";
import { countries, registrationPrice } from "../../Constants";

export default {
  props: {
    currentStudent: {
      type: Boolean,
      default: false
    },
    immigrantStudent: {
      type: Boolean,
      default: false
    },
    registerOnly: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      participantData: {
        title: "Mr.",
        name: "",
        image: "",
        year_of_birth: -1,
        admission_year: -1,
        class: -1,
        group: -1,
        subject: "",
        address: "",
        city: "",
        state: "",
        country: -1,
        zip_code: "",
        mobile_no: "",
        email: "",
        occupation: -1,
        occupation_details: {
          designation: "",
          department: "",
          company_name: "",
          occupation_name: ""
        },
        guests: []
      },
      countries: countries,
      classes: [
        "1st year HSC",
        "1st year BA",
        "1st year BSc",
        "1st year BCom",
        "1st Year 3-4 year Hounors",
        "1st year Master"
      ],
      occupations: [
        "Doctor",
        "Engineer",
        "Lawyer",
        "Service holder",
        "Business Person",
        "House wife",
        "Retired Person",
        "Non-Resident",
        "Others"
      ],
      relations: [
        "Husband",
        "Wife",
        "Son",
        "Daughter",
        "Relative",
        "Personal Staff",
        "Driver",
        "Maids",
        "Others"
      ],
      componentKey: 0,
      selfRegPrice: 0,
      guestRegPrice: 0,
      moneySymbol: this.immigrantStudent ? "$" : "৳",
      loading: false,
      imageRulesUrl: process.env.MIX_APP_ROOT + "/registration/photograph/rules"
    };
  },
  components: {
    inputText,
    imageUpload,
    errors
  },
  mounted() {
    if (this.immigrantStudent) {
      this.selfRegPrice = registrationPrice.immigrant_former_student.self;
      this.guestRegPrice = registrationPrice.immigrant_former_student.guest;
    } else {
      this.selfRegPrice = registrationPrice.former_student_in_bd.self;
      this.guestRegPrice = registrationPrice.former_student_in_bd.guest;
    }

    if (this.currentStudent) {
      this.selfRegPrice = registrationPrice.current_student.self;
      this.guestRegPrice = registrationPrice.current_student.guest;
    }

    if (this.registerOnly) {
      this.guestRegPrice = 0;

      if (this.immigrantStudent) {
        this.selfRegPrice = registrationPrice.nrb_only_registration;
        this.moneySymbol = "$";
      } else {
        this.selfRegPrice = registrationPrice.only_registration;
        this.moneySymbol = "৳";
      }
    }
  },
  computed: {
    totalAmount() {
      return (
        this.selfRegPrice +
        this.participantData.guests.length * this.guestRegPrice
      );
    }
  },
  methods: {
    addGuest() {
      this.participantData.guests.push({
        name: "",
        relation: "-1",
        age: "",
        image: ""
      });
    },
    removeGuest(index) {
      this.participantData.guests.splice(index, 1);
      this.componentKey += index + 1;
    },
    submit() {
      this.loading = true;
      this.$store.dispatch("setValidationErrors", "");

      let data = this.participantData;

      if (this.currentStudent) {
        data.current_student = this.currentStudent;
      }

      if (this.registerOnly) {
        data.only_register = this.registerOnly;
      }

      if (this.immigrantStudent) {
        data.outside_of_bd = true;
      }

      axios
        .post("register/store", data)
        .then(response => {
          console.log(response);
          this.loading = false;
        })
        .catch(error => {
          console.log(error.data);
          this.loading = false;
        });
    }
  }
};
</script>

<style lang="scss" scoped>
.img-thumbnail {
  width: 200px;
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
.registration-form {
  position: relative;
}
.loader_area {
  position: absolute;
  z-index: 99;
  width: 100%;
  height: 100%;
  background: #ffffffc2;
  left: 0;
  top: 0;
}
.loader {
  position: relative;
  top: 50%;
  transform: translateY(-50%);
}
.loader i.fa.fa-spin {
  color: #000000de;
}
</style>
