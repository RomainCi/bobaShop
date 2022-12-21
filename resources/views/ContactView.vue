<template>
  <navbar-component v-on:position="fixed = $event"></navbar-component>
  <main :class="fixed">
    <contact-component></contact-component>
  </main>
  <footer>
    <footer-component></footer-component>
  </footer>
</template>

<script>
import NavbarComponent from "../js/components/NavbarComponent.vue";
import ContactComponent from "../js/components/contact/ContactComponent.vue";
import FooterComponent from "../js/components/FooterComponent.vue";
export default {
  name: "ContactView",
  components: {
    NavbarComponent,
    ContactComponent,
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