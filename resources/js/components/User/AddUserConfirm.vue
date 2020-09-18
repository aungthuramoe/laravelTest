<template>
  <div class="jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 offset-sm-2">
          <div class="mb-4">
            <h2>Create User Confirm</h2>
          </div>
          <div>
            <form @submit.prevent="createUser">
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Name</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    readonly
                    class="form-control-plaintext bg-light pl-2"
                    name="title"
                    v-model="user.name"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Email</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    readonly
                    class="form-control-plaintext bg-light pl-2"
                    name="title"
                    v-model="user.email"/>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Password</label>
                <div class="col-md-6">
                  <input
                    type="password"
                    readonly
                    class="form-control-plaintext bg-light pl-2"
                    name="title"
                    v-model="user.password"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Confirm Password</label>
                <div class="col-md-6">
                  <input
                    type="password"
                    readonly
                    class="form-control-plaintext bg-light pl-2"
                    name="title"
                    v-model="user.confirmPassword"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Type</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    readonly
                    class="form-control-plaintext bg-light pl-2"
                    name="title"
                    v-model="user.type"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Date of Birth</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    readonly
                    class="form-control-plaintext bg-light pl-2"
                    name="title"
                    v-model="user.dob"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Phone</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    readonly
                    class="form-control-plaintext bg-light pl-2"
                    name="title"
                    v-model="user.phone"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label for="description" class="col-md-3 col-form-label">Address</label>
                <div class="col-md-6">
                  <textarea
                    class="form-control bg-light"
                    id="description"
                    name="description"
                    rows="3"
                    disabled
                    v-model="user.address"
                  ></textarea>
                </div>
              </div>
              <div class="form-group">
                <button class="col-md-3 btn btn-dark">Cancel</button>
                <button class="col-md-3 btn btn-success active">Create User</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
const userModule = "UsersModule";
export default {
  data() {
    return {};
  },
  mounted() {
    console.log("User Confirm is mounted");
  },
  computed: {
    user() {
      return this.$store.state[userModule].user;
    },
  },
  methods: {
    createUser() {
        axios
          .post("/api/users", this.user)
          .then((response) => {
            console.log("USER RESPONSE ::: ", response);
            this.$router.push({
              name: "users",
            });
          })
          .catch((error) => {
            console.log("USER ERROR ::: ", error);
            this.$router.push({
              name: "users-create",
            });
          });
    },
  },
};
</script>