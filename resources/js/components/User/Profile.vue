<template>
  <div>
    <h1>Profile</h1>
    <button @click="showInfo" class="btn btn-primary">show Userinfo</button>
  </div>
</template>
<script>
const postModule = "PostsModule";
const userModule = "UsersModule";
export default {
  data() {
    return {};
  },
  mounted() {
    console.log("Profile is mounted");
  },
  methods: {
  showInfo() {
      console.log(localStorage.getItem('user'));
  }
  },
};
</script>
