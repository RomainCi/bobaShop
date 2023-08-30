<template>
  <header>
    <navbar-component></navbar-component>
  </header>
  <main>
    <basket-component></basket-component>
  </main>
    <footer>
        <footer-component></footer-component>
    </footer>
</template>

<script>
import BasketComponent from "../js/components/panier/BasketComponent.vue";
import NavbarComponent from "../js/components/NavbarComponent.vue";
import footerComponent from "@/components/FooterComponent.vue";

export default {
  name: "BasketView",
  components: {
    BasketComponent,
    NavbarComponent,
      footerComponent,
  }
}
</script>

<style scoped>

</style>
