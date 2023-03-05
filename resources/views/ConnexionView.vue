<template>
  <header>
    <navbar-component></navbar-component>
  </header>
  <main>
    <connexion-component></connexion-component>
  </main>
</template>

<script>
import ConnexionComponent from "../js/components/connexion/ConnexionComponent.vue";
import NavbarComponent from "../js/components/NavbarComponent.vue";

export default {
  name: "ConnexionView",
  components: {
    ConnexionComponent,
    NavbarComponent,
  }
}
</script>

<style scoped>

</style>