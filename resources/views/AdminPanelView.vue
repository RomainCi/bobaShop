<template>
  <header>
    <navbar-component></navbar-component>
  </header>
  <main>
    <admin-panel-component></admin-panel-component>
  </main>
</template>

<script>
import AdminPanelComponent from "../js/components/panel/AdminPanelComponent.vue";
import NavbarComponent from "../js/components/NavbarComponent.vue";

export default {
  name: "AdminPanelView",
  components: {
    AdminPanelComponent,
    NavbarComponent
  }
}
</script>

<style scoped>

</style>