<template>
  <header>
    <navbar-component v-on:position="fixed= $event"></navbar-component>
  </header>
  <main :class="fixed">
    <faq-component></faq-component>
  </main>
  <footer>
    <footer-component></footer-component>
  </footer>
</template>

<script>
import NavbarComponent from "../js/components/NavbarComponent.vue";
import FaqComponent from "../js/components/faq/FaqComponent.vue";
import FooterComponent from "../js/components/FooterComponent.vue";

export default {
  name: "FaqView",
    emits: ['position'],
  components: {
    NavbarComponent,
    FaqComponent,
    FooterComponent,
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
