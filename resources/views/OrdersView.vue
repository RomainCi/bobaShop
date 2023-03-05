<template>
  <header>
    <NavbarComponent></NavbarComponent>
  </header>
  <main>
    <OrdersComponent></OrdersComponent>
  </main>
</template>

<script>
import NavbarComponent from "../js/components/NavbarComponent.vue";
import OrdersComponent from "../js/components/commandes/OrdersComponent.vue";

export default {
  name: "OrdersView",
  components: {
    NavbarComponent,
    OrdersComponent,
  }
}
</script>

<style scoped>

</style>