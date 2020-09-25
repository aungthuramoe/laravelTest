<template>
  <div class="jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 offset-sm-2">
          <div class="mb-4">
            <h2>Update User Confirm</h2>
          </div>
          <div>
            <form @submit.prevent="updateUser">
              <div class="form-group row justify-content-end">
                <img
                  :src="profile"
                  style="width: 100px; height: 100px"
                  class="rounded"
                  alt="profile"
                />
              </div>
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
                    v-model="user.email"
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
                <label for="description" class="col-md-3 col-form-label"
                  >Address</label
                >
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
                <button class="col-md-3 btn btn-success active">
                  Update User
                </button>
              </div>
            </form>
            <button @click="cancelUser()" class="col-md-3 btn btn-dark">
              Cancel
            </button>
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
    return {
      profile: "",
    };
  },
  mounted() {
    this.profile = localStorage.getItem("updateProfile");
  },
  computed: {
    user() {
      return this.$store.state[userModule].updateUser;
    },
  },
  methods: {
    updateUser() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
        },
      };
      let formData = new FormData();
      formData.append("name", this.user.name);
      formData.append("email", this.user.email);
      formData.append("dob", this.user.dob);
      formData.append("phone", this.user.phone);
      formData.append("address", this.user.address);
      formData.append("user_type", this.user.type);
      formData.append("profile", this.user.profile);
      formData.append("_method", "put");
      axios
        .post(`/api/users/${this.user.id}`, formData, config)
        .then((response) => {
          if (response["data"].status == "success") {
            this.$store.dispatch("addUpdateUserToCurrentUser", this.user);
            this.$router.push({
              name: "profile",
            });
          } else {
            this.$router.push({
              name: "users",
            });
          }
        })
        .catch((error) => {
          console.log("ERROR ::: ", error);
          this.$router.push({
            name: "edit-profile",
          });
        });
    },
    cancelUser() {
      this.$router.back();
    },
  },
};
</script>