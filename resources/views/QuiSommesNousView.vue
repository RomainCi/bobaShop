<template>
  <header>
    <navbar-component v-on:position="fixed = $event"></navbar-component>
  </header>
  <main :class="fixed">
    <qui-sommes-nous-component></qui-sommes-nous-component>
  </main>
  <footer>
    <footer-component></footer-component>
  </footer>
</template>

<script>
import NavbarComponent from "../js/components/NavbarComponent.vue";
import QuiSommesNousComponent from "../js/components/quiSommesNous/QuiSommesNousComponent.vue";
import FooterComponent from "../js/components/FooterComponent.vue";
export default {
  name: "QuiSommesNousView",
  components: {
    NavbarComponent,
    QuiSommesNousComponent,
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
  width: 100%;
}

.fixed {
  position: fixed;
  z-index: 0;
  /*top: 0;*/
  left: 0;
  right: 0;
}
</style>