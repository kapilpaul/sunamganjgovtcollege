<template>
  <div>
    <div class="registration-form p-0 pb-100">
      <span class="addtocalendar atc-style-theme registrationPriceFloating">
        <a class="atcb-link" tabindex="1" id>{{ totalAmount }}</a>
      </span>

      <form action method="POST" target="_top" id>
        <div class="row">
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
            <div class="form-grou">
              <label class="col-md-12 ml-0 pl-0">Upload Image</label>
              <div class="col-md-4 pl-0">
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
                <option
                  v-for="(n, keyIn) in 70"
                  :value="keyIn + 1944"
                  :key="keyIn"
                >{{ keyIn + 1944 }}</option>
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
              name="companty_name"
              placeholder="Company Name"
              v-model="participantData.occupation_details.companty_name"
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
            <input-text
              label="Age"
              name="age"
              placeholder="Age"
              :required="true"
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
import imageUpload from "../common/upload/image";
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
        title: "Mr.",
        name: "",
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
        guests: [
          {
            name: "",
            relation: "",
            age: "",
            image: ""
          }
        ]
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
      componentKey: 0
    };
  },
  components: {
    inputText,
    imageUpload
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
        age: "",
        image: ""
      });
    },
    removeGuest(index) {
      this.participantData.guests.splice(index, 1);
      this.componentKey += index + 1;
    },
    test(val) {
      console.log(val);
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
</style>