<template>
  <div>
    <!-- <h1>Profile -> {{isLogin}}</h1>-->
    <!-- <p>{{currentUser}}</p> -->
    <div class="card">
      <div class="card-header text-center">
        <strong class="text-primary">User Profile</strong>
      </div>
      <div class="card-body ml-5">
        <form>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10 col-lg-6">
              <input
                type="text"
                class="form-control-plaintext"
                readonly
                name="name"
                v-model="currentUser.name"
              />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Profile Image</label>
            <div class="col-sm-10 col-lg-9">
              <img
                style="width:100px;height:80px"
                :src="'/storage/images/'+currentUser.profile"
                class="rounded"
                alt="profile"
              />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10 col-lg-6">
              <input
                type="text"
                readonly
                class="form-control-plaintext"
                name="email"
                v-model="currentUser.email"
              />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Type</label>
            <div class="col-sm-10 col-lg-6">
              <!-- <input type="text" readonly class="form-control-plaintext" name="type" v-model="currentUser.type"> -->
              <input
                type="text"
                readonly
                class="form-control-plaintext"
                name="type"
                value="User"
                v-if="currentUser.type == 1"
              />
              <input
                type="text"
                readonly
                class="form-control-plaintext"
                name="type"
                value="Admin"
                v-else
              />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10 col-lg-6">
              <input
                type="text"
                readonly
                class="form-control-plaintext"
                name="phone"
                v-model="currentUser.phone"
              />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Date of Birth</label>
            <div class="col-sm-10 col-lg-6">
              <input
                type="text"
                readonly
                class="form-control-plaintext"
                name="dob"
                v-model="currentUser.dob"
              />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10 col-lg-6">
              <input
                type="text"
                readonly
                class="form-control-plaintext"
                name="address"
                v-model="currentUser.address"
              />
            </div>
          </div>
        </form>
        <div class="form-group row">
          <div class="col-sm-10 col-lg-4">
            <router-link :to="{name:'edit-profile'}" class="btn btn-block btn-primary text-uppercase">Edit</router-link>
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
  computed: {
    isLogin() {
      return this.$store.state[userModule].isLogin;
    },
    currentUser() {
      return this.$store.state[userModule].currentUser;
    },
  },
  methods: {},
};
</script>
