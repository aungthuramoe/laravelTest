<template>
  <ul class="c-sidebar-nav ps ps--active-y">
    <h3 v-if="isLogin" class="c-sidebar-nav-item text-center mt-3">
      {{ currentUser.name }}
    </h3>
    <li v-if="isLogin" class="c-sidebar-nav-item">
      <router-link to="/vue-profile" class="c-sidebar-nav-link">
        <i class="fas fa-user-circle fa-lg c-sidebar-nav-icon text-warning"></i
        >Profile
      </router-link>
    </li>
    <li class="c-sidebar-nav-item">
      <router-link to="/posts" class="c-sidebar-nav-link">
        <i class="fas fa-file-alt fa-lg c-sidebar-nav-icon text-info"></i>Posts
      </router-link>
    </li>
    <li v-if="isLogin && currentUser.type == 0" class="c-sidebar-nav-item">
      <router-link to="/all-user" class="c-sidebar-nav-link">
        <i class="fas fa-users fa-lg text-light c-sidebar-nav-icon"></i>Users
      </router-link>
    </li>
    <li v-if="!isLogin" class="c-sidebar-nav-item">
      <router-link to="/vue-login" class="c-sidebar-nav-link">
        <i class="fas fa-user fa-lg text-success c-sidebar-nav-icon"></i>Login
      </router-link>
    </li>
    <li v-if="isLogin" class="c-sidebar-nav-item">
      <router-link
        @click.native="logout"
        to="/posts"
        class="c-sidebar-nav-link"
      >
        <i class="fas fa-sign-out-alt fa-lg text-danger c-sidebar-nav-icon"></i
        >Logout
      </router-link>
    </li>
  </ul>
</template>

<script>
export default {
  data() {
    return {};
  },
  computed: {
    isLogin() {
      return this.$store.state.UsersModule.isLogin;
    },
    currentUser() {
      return this.$store.state.UsersModule.currentUser;
    },
  },
  methods: {
    logout() {
      console.log(localStorage.getItem("token"));
     axios.defaults.headers.common["Authorization"] = `Bearer ${localStorage.getItem("token")}`;
      axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
      axios
        .post("http://localhost:8000/api/auth/logout")
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
      this.$store.dispatch("isLogin", { isLogin: false, currentUser: null });
      this.$router.push({
          name:'login'
      })
    },
  },
};
</script>