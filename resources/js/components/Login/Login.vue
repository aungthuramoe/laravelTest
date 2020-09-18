<template>
  <div class="jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-2">
          <div>
            <h2 class="text-center">Login</h2>
            <form @submit.prevent="handleSubmit">
              <div class="form-group">
                <label for="title">Username</label>
                <input
                  type="text"
                  v-model="user.email"
                  id="email"
                  name="email"
                  class="form-control"
                  placeholder="Enter email"
                  :class="{ 'is-invalid': submitted && $v.user.email.$error }"
                />
                <div
                  v-if="submitted && !$v.user.email.required"
                  class="invalid-feedback"
                >Email is required</div>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input
                  type="password"
                  v-model="user.password"
                  name="password"
                  class="form-control"
                  placeholder="Enter Password"
                  :class="{ 'is-invalid': submitted && $v.user.password.$error }"
                />
                <div
                  v-if="submitted && !$v.user.password.required"
                  class="invalid-feedback"
                >Password is required</div>
              </div>
              <span v-if="error" class="text-danger">Please enter correct email and password</span>
              <div class="form-group mt-2">
                <button class="col-md-3 btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
export default {
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
      error: false,
      submitted: false,
    };
  },
  validations: {
    user: {
      email: { required },
      password: { required },
    },
  },
  methods: {
    handleSubmit(e) {
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      axios
        .post("/api/vuelogin", {
          email: this.user.email,
          password: this.user.password,
        })
        .then((response) => {
          let user = response["data"];
          if (!user) {
            this.error = true;
          } else {
            this.error = false;
            if (user.type == 0) {
              localStorage.setItem("isAdmin", true);
            } else {
              localStorage.setItem("isAdmin", false);
            }

            this.$store.dispatch("isLogin", {
              isLogin: true,
              currentUser: user,
            });
            this.$router.push({
              name: "posts",
            });
          }
        })
        .catch((error) => {
          console.log("ERROR :: ", error);
        });
    },
  },
};
</script>