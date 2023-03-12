<template>
  <section>
    <admin-home-page-component></admin-home-page-component>
  </section>
  <section>
    <admin-menu-component></admin-menu-component>
  </section>
  <section>

  </section>
</template>

<script>
import AdminHomePageComponent from "@/components/panel/AdminHomePageComponent.vue";
import AdminMenuComponent from "@/components/panel/AdminMenuComponent.vue";
export default {
  name: "AdminPanelComponent",
  components: {
    AdminHomePageComponent,
    AdminMenuComponent,
  },

}
</script>

<style scoped>

</style>