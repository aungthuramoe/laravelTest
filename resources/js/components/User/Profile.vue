<template>
  <div>
    <h1>Profile -> {{isLogin}}</h1>
    <p> {{currentUser}}</p>
    <button @click="showInfo" class="btn btn-primary">show Userinfo</button>
  </div>
</template>
<script>
const userModule = "UsersModule";
export default {
  data() {
    return {};
  },
  mounted() {
    console.log("Profile is mounted");
    console.log('admin or user',localStorage.getItem('isAdmin'))
  },
  computed: {
    isLogin() {
      return this.$store.state[userModule].isLogin;
    },
    currentUser() {
        return this.$store.state[userModule].currentUser;
    }
  },
  methods: {
    showInfo() {
      console.log(localStorage.getItem("user"));
    },
  },
};
</script>
