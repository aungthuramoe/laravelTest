<template>
  <ul class="c-sidebar-nav ps ps--active-y">
    <li class="c-sidebar-nav-item">
      <router-link to="/posts" class="c-sidebar-nav-link">
        <div class="c-sidebar-nav-icon"></div>All Posts
      </router-link>
    </li>
    <li class="c-sidebar-nav-item">
      <router-link to="/profile" class="c-sidebar-nav-link">
        <div class="c-sidebar-nav-icon"></div>Profile
      </router-link>
    </li>
    <li class="c-sidebar-nav-item">
      <router-link to="/users" class="c-sidebar-nav-link">
        <div class="c-sidebar-nav-icon"></div>Users
      </router-link>
    </li>
    <li class="c-sidebar-nav-item">
      <router-link to="/users-create" class="c-sidebar-nav-link">
        <div class="c-sidebar-nav-icon"></div>Add Users
      </router-link>
    </li>
  </ul>
</template>

<script>
export default {
  data() {
    return {};
  },
  mounted() {
    console.log("Component side bar mounted.");
  },
};
</script>