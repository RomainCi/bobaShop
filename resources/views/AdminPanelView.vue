<template>
  <header>
    <navbar-component></navbar-component>
  </header>
  <main>
    <admin-panel-component></admin-panel-component>
  </main>
</template>

<script>
import AdminPanelComponent from "@/components/panel/AdminPanelComponent.vue";
import NavbarComponent from "@/components/NavbarComponent.vue";

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