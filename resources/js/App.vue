<template>
  <header>
    <navbar-component></navbar-component>
  </header>
  <router-view></router-view>
  <footer>
    <footer-component></footer-component>
  </footer>
</template>

<script>
import NavbarComponent from "./components/NavbarComponent.vue";
import FooterComponent from "./components/FooterComponent.vue";

export default {
  name: "App",
  components: {
    NavbarComponent,
    FooterComponent,
  }

}
</script>

<style scoped>

</style>