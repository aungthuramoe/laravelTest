<template>
  <h2>I'm Edit {{ title }}</h2>
</template>
<script>
import { mapState } from "vuex";
export default {
  computed: mapState(["title"]),
};
</script>