<template>
  <header>
    <navbar-component v-on:position="fixed= $event"></navbar-component>
  </header>
  <main :class="fixed">
    <faq-component></faq-component>
  </main>
</template>

<script>
import NavbarComponent from "../js/components/NavbarComponent.vue";
import FaqComponent from "../js/components/faq/FaqComponent.vue";

export default {
  name: "FaqView",
  components: {
    NavbarComponent,
    FaqComponent
  },
  data() {
    return {
      fixed: "notFixed"
    }
  }
}
</script>

<style scoped>
main {
  background-color: white;
}

.fixed {
  position: fixed;
  right: 0;
  left: 0;
}
</style>