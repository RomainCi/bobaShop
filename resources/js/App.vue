<template>
  <router-view></router-view>
</template>

<script>

import FooterComponent from "./components/FooterComponent.vue";

export default {
  name: "App",
  props: {
    test: Number
  },
  components: {
    FooterComponent,
  },
  mounted() {
    console.log(this.test);
    this.$store.dispatch('checkAdmin', this.test);
  }

}
</script>

<style scoped>

</style>