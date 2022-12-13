<template>
  <router-view></router-view>
  <footer>
    <footer-component></footer-component>
  </footer>
</template>

<script>

import FooterComponent from "./components/FooterComponent.vue";

export default {
  name: "App",
  components: {
    FooterComponent,
  }

}
</script>

<style scoped>

</style>