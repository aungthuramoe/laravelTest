<template>
  <ul class="c-sidebar-nav ps ps--active-y">
    <li class="c-sidebar-nav-item">
      <router-link to="/vue-profile" class="c-sidebar-nav-link">
        <i class="fas fa-user-circle fa-lg c-sidebar-nav-icon text-warning"></i>Profile
      </router-link>
    </li>
    <li class="c-sidebar-nav-item">
      <router-link to="/posts" class="c-sidebar-nav-link">
        <i class="fas fa-file-alt fa-lg c-sidebar-nav-icon text-info"></i>Posts
      </router-link>
    </li>
    <li class="c-sidebar-nav-item">
      <router-link to="/all-user" class="c-sidebar-nav-link">
        <i class="fas fa-users fa-lg text-light c-sidebar-nav-icon"></i>Users
      </router-link>
    </li>
    <li class="c-sidebar-nav-item">
      <router-link to="/vue-login" class="c-sidebar-nav-link">
        <i class="fas fa-user fa-lg text-success c-sidebar-nav-icon"></i>Login
      </router-link>
    </li>
    <li class="c-sidebar-nav-item">
      <router-link @click.native="logout" to="/posts" class="c-sidebar-nav-link">
        <i class="fas fa-sign-out-alt fa-lg text-danger c-sidebar-nav-icon"></i>Logout
      </router-link>
    </li>
  </ul>
</template>

<script>
export default {
  data() {
    return {};
  },
  beforeCreate() {
    console.log("before create");
    if (localStorage.getItem("user") == null) {
      console.log("user is null");
    } else {
      console.log(localStorage.getItem("user"));
    }
  },
  mounted() {
    console.log("Component side bar mounted => ");
  },
  methods: {
    logout() {
      console.log("logout click");
      axios
        .post("/api/user/logout")
        .then((response) => {
          console.log("RESPONSE -> ", response);
           localStorage.removeItem("user");
        })
        .catch((error) => {
          console.log("Error", error);
        });
    },
  },
};
</script>