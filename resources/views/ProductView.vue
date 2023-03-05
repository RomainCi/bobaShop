<template>
  <main>
    <product-component></product-component>
  </main>
</template>

<script>
import ProductComponent from "../js/components/produit/ProductComponent.vue";

export default {
  name: "ProductView",
  components: {
    ProductComponent,
  }
}
</script>

<style scoped>

</style>