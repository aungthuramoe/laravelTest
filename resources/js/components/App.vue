<template>
  <div class="container">
    <router-view></router-view>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
  name: "app",
  data() {
    return {
      user: null,
    };
  },
  created() {
  },
  mounted() {
    console.log("App is mounted");
  },
  computed: {
    ...mapState({
      alert: (state) => state.alert,
    }),
  },
  methods: {
    ...mapActions({
      clearAlert: "clear",
    }),
    init() {
      axios
        .get("/api/user/info")
        .then((response) => {
          this.user = response["data"];
          console.log("RESPONSE :: Show User info -> ", response["data"]);
        })
        .catch((error) => {
          console.log("ERROR :: ", error);
        });
    },
  },
  watch: {
    $route(to, from) {
      // clear alert on location change
      this.clearAlert();
    },
  },
};
</script>
