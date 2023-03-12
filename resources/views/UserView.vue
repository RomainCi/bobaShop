<template>
  <header>
<navbar-component></navbar-component>
  </header>
<main>
  <CompteComponent></CompteComponent>
</main>
</template>

<script>
import CompteComponent from "../js/components/compte/CompteComponent.vue";
import NavbarComponent from "@/components/NavbarComponent.vue";
export default {
  name: "UserView",
  components:{
    CompteComponent,
    NavbarComponent
  },
}
</script>

<style scoped>

</style>