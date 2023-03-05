<template>
  <header>
    <navbar-component></navbar-component>
  </header>
  <main>
    <compte-component></compte-component>
  </main>
</template>

<script>
import CompteComponent from "../js/components/compte/CompteComponent.vue";
import NavbarComponent from "../js/components/NavbarComponent.vue";

export default {
  name: "CompteView",
  components: {
    CompteComponent,
    NavbarComponent,
  }
}
</script>

<style scoped>

</style>