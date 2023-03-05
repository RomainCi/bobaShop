<template>
  <header>
    <navbar-component></navbar-component>
  </header>
  <main>
    <basket-component></basket-component>
  </main>
</template>

<script>
import BasketComponent from "../js/components/panier/BasketComponent.vue";
import NavbarComponent from "../js/components/NavbarComponent.vue";

export default {
  name: "BasketView",
  components: {
    BasketComponent,
    NavbarComponent
  }
}
</script>

<style scoped>

</style>