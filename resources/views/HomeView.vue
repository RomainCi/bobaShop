<template>
  <header>
    <navbar-component v-on:position="fixed = $event"></navbar-component>
  </header>
  <main :class="fixed">
    <magasin-component></magasin-component>
    <bubble-tea-component></bubble-tea-component>
    <menu-component></menu-component>
    <creation-bubble-tea-component></creation-bubble-tea-component>
    <sides-component></sides-component>
  </main>
  <footer>
    <footer-component></footer-component>
  </footer>
</template>

<script>
import MagasinComponent from "../js/components/accueil/MagasinComponent.vue";
import MenuComponent from "../js/components/accueil/MenuComponent.vue";
import CreationBubbleTeaComponent from "../js/components/accueil/CreationBubbleTeaComponent.vue";
import SidesComponent from "../js/components/accueil/SidesComponent.vue";
import SauceComponent from "../js/components/accueil/SauceComponent.vue";
import NavbarComponent from "../js/components/NavbarComponent.vue";
import BubbleTeaComponent from "../js/components/accueil/BubbleTeaComponent.vue";
import FooterComponent from "../js/components/FooterComponent.vue";

export default {
  name: "HomeView",
  components: {
    NavbarComponent,
    MagasinComponent,
    MenuComponent,
    CreationBubbleTeaComponent,
    SidesComponent,
    SauceComponent,
    BubbleTeaComponent,
    FooterComponent,
  },
  data() {
    return {
      fixed: "notFixed"
    }
  }
}
</script>

<style lang="scss" scoped>

main {
  background-color: white;
}

.fixed {
  position: fixed;
  right: 0;
  left: 0;
}
</style>