<template>
  <div class="jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 offset-sm-2">
          <div>
            <div class="mb-3">
              <h2>Create User</h2>
            </div>
            <form @submit.prevent="handleSubmit">
              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="name">Name</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    v-model="user.name"
                    id="name"
                    name="name"
                    placeholder="Name"
                    class="form-control"
                    :class="{ 'is-invalid': submitted && $v.user.name.$error }"
                  />
                  <div
                    v-if="submitted && !$v.user.name.required"
                    class="invalid-feedback"
                  >Name is required</div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="email">Email</label>
                <div class="col-md-6">
                  <input
                    type="email"
                    v-model="user.email"
                    id="email"
                    name="email"
                    placeholder="Email"
                    class="form-control"
                    :class="{ 'is-invalid': submitted && $v.user.email.$error }"
                  />
                  <div v-if="submitted && $v.user.email.$error" class="invalid-feedback">
                    <span v-if="!$v.user.email.required">Email is required</span>
                    <span v-if="!$v.user.email.email">Email is invalid</span>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="password">Password</label>
                <div class="col-md-6">
                  <input
                    type="password"
                    v-model="user.password"
                    id="password"
                    name="password"
                    placeholder="Password"
                    class="form-control"
                    :class="{ 'is-invalid': submitted && $v.user.password.$error }"
                  />
                  <div v-if="submitted && $v.user.password.$error" class="invalid-feedback">
                    <span v-if="!$v.user.password.required">Password is required</span>
                    <span v-if="!$v.user.password.minLength">Password must be at least 6 characters</span>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="confirmPassword">Confirm Password</label>
                <div class="col-md-6">
                  <input
                    type="password"
                    v-model="user.confirmPassword"
                    id="confirmPassword"
                    name="confirmPassword"
                    placeholder="Confirm Password"
                    class="form-control"
                    :class="{ 'is-invalid': submitted && $v.user.confirmPassword.$error }"
                  />
                  <div v-if="submitted && $v.user.confirmPassword.$error" class="invalid-feedback">
                    <span v-if="!$v.user.confirmPassword.required">Confirm Password is required</span>
                    <span v-else-if="!$v.user.confirmPassword.sameAsPassword">Passwords must match</span>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="type">User Type</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    v-model="user.type"
                    id="type"
                    name="type"
                    placeholder="type"
                    class="form-control"
                    :class="{ 'is-invalid': submitted && $v.user.type.$error }"
                  />
                  <div
                    v-if="submitted && !$v.user.type.required"
                    class="invalid-feedback"
                  >Type is required</div>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="phone">Phone Number</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    v-model="user.phone"
                    id="phone"
                    name="phone"
                    placeholder="Phone"
                    class="form-control"
                    :class="{ 'is-invalid': submitted && $v.user.phone.$error }"
                  />
                  <div v-if="submitted && $v.user.phone.$error" class="invalid-feedback">
                    <span v-if="!$v.user.phone.required">Phone Number is required</span>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="dob">Date of Birth</label>
                <div class="col-md-6">
                  <input type="date" v-model="user.dob" id="name" name="dob" class="form-control" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="address">Address</label>
                <div class="col-md-6">
                  <textarea
                    class="form-control"
                    v-model="user.address"
                    id="address"
                    name="address"
                    placeholder="Enter Address"
                    rows="5"
                  ></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="profile">Profile Image</label>
                <div class="col-md-6">
                  <input
                    type="file"
                    id="profile"
                    name="profile"
                    class="form-control"
                    :class="{ 'is-invalid': submitted && $v.user.profile.$error }"
                  />
                  <!-- <div v-if="submitted && $v.user.profile.$error" class="invalid-feedback">
                    <span v-if="!$v.user.profile.required">User Profile is required</span>
                  </div>-->
                </div>
              </div>
              <div class="form-group">
                <button type="reset" class="btn btn-dark">Clear</button>
                <button class="btn btn-success active">Confirm</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
const userModule = "UsersModule";
export default {
  name: "app",
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        confirmPassword: "",
        address: "",
        type: "",
        phone: "",
        dob: "",
        profile: "",
      },
      submitted: false,
    };
  },
  mounted() {
    if(this.$store.state[userModule].user.name != undefined){
        this.user = this.$store.state[userModule].user
    }
  },
  validations: {
    user: {
      name: { required },
      email: { required, email },
      password: { required, minLength: minLength(6) },
      confirmPassword: { required, sameAsPassword: sameAs("password") },
      address: { required },
      type: { required },
      phone: "",
      dob: "",
      profile: "",
    },
  },
  methods: {
    handleSubmit(e) {
      this.submitted = true;
      if (this.$v.$invalid) {
        return;
      }
      this.$store.dispatch("addUser", this.user);
    },
  },
};
</script>