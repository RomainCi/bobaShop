<template>
  <navbar-component v-on:position="fixed = $event"></navbar-component>
  <main :class="fixed">
    <contact-component></contact-component>
  </main>
</template>

<script>
import NavbarComponent from "../js/components/NavbarComponent.vue";
import ContactComponent from "../js/components/contact/ContactComponent.vue";
export default {
  name: "ContactView",
  components: {
    NavbarComponent,
    ContactComponent,
  },
  data(){
    return{
      fixed:"notFixed"
    }
  }
}
</script>

<style scoped>
main{
  background-color: #EBF0E4;
}
.fixed{
  position: fixed;
}
</style>