<template>
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="col card-header">
          <h1 class="display-5 my-2 text-primary text-center">Change Password</h1>
        </div>
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row justify-content-center">
            <div class="col-lg-9">
              <div class="p-0">
                <form @submit.prevent="changePassword()">
                  <div class="form-group row mt-3">
                    <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
                    <div class="col-sm-9">
                      <input
                        id="current_password"
                        type="password"
                        class="form-control form-control-user"
                        name="current_password"
                        v-model="currentPassword"
                        :class="{ 'is-invalid':  $v.currentPassword.$error }"
                        placeholder="Enter Current Password"
                      />
                      <div
                        v-if="!$v.currentPassword.required"
                        class="invalid-feedback"
                      >Current Password is required</div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                      <input
                        name="password"
                        type="password"
                        v-model="password"
                        class="form-control form-control-user"
                        :class="{ 'is-invalid':  $v.password.$error }"
                        id="passsword"
                        placeholder="New Password"
                      />
                      <div
                        v-if="!$v.password.required"
                        class="invalid-feedback"
                      >Password is required</div>
                    </div>
                  </div>
                  <div class="form-group row d-flex">
                    <label
                      for="password_confirmation"
                      class="col-sm-3 col-form-label"
                    >Confirm Password</label>
                    <div class="col-sm-9">
                      <input
                        name="password_confirmation"
                        type="password"
                        v-model="confirmPassword"
                        :class="{ 'is-invalid':  $v.confirmPassword.$error }"
                        class="form-control form-control-user"
                        id="password_confirmation "
                        placeholder="Confirm Password"
                      />
                      <div
                        v-if="!$v.confirmPassword.required"
                        class="invalid-feedback"
                      >Confirm Password is required</div>
                    </div>
                    <div
                      v-if="!$v.confirmPassword.sameAsPassword"
                      class="invalid-feedback"
                    >Passwords must match</div>
                    <div v-if="error" class="text-danger">{{message}}</div>
                  </div>

                  <button
                    class="col-sm-12 col-lg-12 btn btn-success text-uppercase btn-block"
                  >Change</button>
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
import {
  helpers,
  required,
  sameAs,
  minLength,
  not,
} from "vuelidate/lib/validators";
const alpha = helpers.regex("alpha", /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/);
export default {
  data() {
    return {
      currentPassword: "",
      password: "",
      confirmPassword: "",
      error: false,
      message: "",
    };
  },
  computed: {
    currentUser() {
      return this.$store.state.UsersModule.currentUser;
    },
  },
  mounted() {},
  validations: {
    currentPassword: { required, minLength: minLength(6) },
    password: { required, alpha, minLength: minLength(6) },
    confirmPassword: { required, sameAsPassword: sameAs("password") },
  },
  methods: {
    changePassword() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      if (this.currentPassword == this.password) {
        this.error = true;
        this.message = "Current Password does not same with old password";
        return;
      } else {
        this.error = false;
        this.message = "";
      }
      axios
        .post("api/user/change-password", {
          password: this.password,
          id: this.currentUser.id,
          currentPassword: this.currentPassword,
        })
        .then((response) => {
          let result = response['data'];
          if(result.error == false) {
              this.$router.push({
                  name:'edit-profile'
              })
          }else{
              this.error = true;
              this.message = "Current Password does not match with old password"
          }
        })
        .catch((error) => {
          console.log("ERROR RESPONSE ::: ", error);
        });
    },
  },
};
</script>

<style>
</style>