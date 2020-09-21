<template>
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
      <div class="card border-0 shadow-lg my-5">
        <div class="col card-header">
          <h1 class="display-5 my-2 text-primary text-center">Update User</h1>
        </div>
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row justify-content-center">
            <div class="col-lg-9">
              <div class="p-0">
                <form @submit.prevent="updateUser()" enctype="multipart/form-data">
                  <div class="form-group row">
                    <div class="col-sm-10 col-lg-12 mt-3">
                      <img
                        style="width:80px;height:80px;"
                        :src="'/storage/images/'+currentUser.profile"
                        class="rounded float-right"
                        alt="profile"
                      />
                    </div>
                  </div>
                  <div class="form-group row mt-3">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      <input
                        id="name"
                        type="text"
                        class="form-control form-control-user"
                        :class="{ 'is-invalid': submitted && $v.user.name.$error }"
                        name="name"
                        v-model="user.name"
                        placeholder="Name"
                      />
                      <div
                        v-if="submitted && !$v.user.name.required"
                        class="invalid-feedback"
                      >Username is required</div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input
                        id="email"
                        type="text"
                        class="form-control form-control-user"
                        name="email"
                        :class="{ 'is-invalid': submitted && $v.user.email.$error }"
                        v-model="user.email"
                        placeholder="Email"
                      />
                      <div
                        v-if="submitted && !$v.user.email.required"
                        class="invalid-feedback"
                      >Email is required</div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="user_type" class="col-sm-3 col-form-label">User Type</label>
                    <div class="col-sm-9">
                      <select
                        v-if="currentUser.type == 0"
                        class="form-control form-control-user"
                        name="type"
                        id="type"
                      >
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                      </select>
                      <select
                        v-else
                        class="form-control form-control-user"
                        disabled
                        name="type"
                        id="type"
                      >
                        <option value="User">User</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="phone_number" class="col-sm-3 col-form-label">Phone Number</label>
                    <div class="col-sm-9">
                      <input
                        name="phone"
                        type="text"
                        class="form-control form-control-user"
                        v-model="user.phone"
                        id="phone_number"
                        placeholder="Phone Number"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                    <div class="col-sm-9">
                      <input
                        name="dob"
                        type="date"
                        v-model="user.dob"
                        class="form-control form-control-user"
                        id="dob"
                        placeholder="Date of Birth"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                      <input
                        name="address"
                        type="text"
                        v-model="user.address"
                        class="form-control form-control-user"
                        :class="{ 'is-invalid': submitted && $v.user.address.$error }"
                        id="address"
                        placeholder="Address"
                      />
                      <div
                        v-if="submitted && !$v.user.address.required"
                        class="invalid-feedback"
                      >Address is required</div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="profile_image" class="col-sm-3 col-form-label">Profile Image</label>
                    <div class="col-sm-9">
                      <input
                        id="profile_image"
                        accept="image/jpeg, image/jpg, image/png"
                        type="file"
                        :class="{ 'is-invalid': submitted && $v.user.profile.$error }"
                        class="form-control form-control-user"
                        name="profile"
                      />
                      <div
                        v-if="submitted && !$v.user.profile.required"
                        class="invalid-feedback"
                      >Profile is required</div>
                      <img id="profile_image-tag" width="200px" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <router-link :to="{name:'change-password'}" class="btn btn-link">
                      <u class="pb-1">Change Password</u>
                    </router-link>
                  </div>
                  <button
                    type="submit"
                    class="col-sm-12 col-lg-12 btn btn-success text-uppercase btn-block"
                  >Confirm</button>
                  <button
                    type="reset"
                    class="col-sm-12 col-lg-12 btn btn-secondary text-uppercase btn-block mb-3"
                  >Clear</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength, maxLength } from "vuelidate/lib/validators";
const userModule = "UsersModule";
export default {
  data() {
    return {
      user: {
        id: "",
        name: "",
        email: "",
        profile: "",
        type: "",
        phone: "",
        dob: "",
        address: "",
      },
      submitted: false,
    };
  },
  validations: {
    user: {
      name: { required },
      email: { required },
      profile: { required },
      type: { required },
      address: { required },
    },
  },
  mounted() {
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#profile_image-tag").attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#profile_image").change(function () {
      readURL(this);
    });

    if (this.currentUser) {
      this.user.name = this.currentUser.name;
      this.user.email = this.currentUser.email;
      this.user.profile = this.currentUser.profile;
      this.user.phone = this.currentUser.phone;
      this.user.dob = this.currentUser.dob;
      this.user.type = this.currentUser.type;
      this.user.address = this.currentUser.address;
    }
  },
  computed: {
    currentUser() {
      return this.$store.state[userModule].currentUser;
    },
  },
  methods: {
    updateUser() {
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      console.log("updateUser");
    },
  },
};
</script>

<style>
</style>