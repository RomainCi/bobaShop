<template>
    <header>
        <NavbarComponent></NavbarComponent>
    </header>
    <main>
        <inscription-component></inscription-component>
    </main>
    <footer>
        <footer-component></footer-component>
    </footer>
</template>

<script>
import InscriptionComponent from "../js/components/register/RegisterComponent.vue";
import NavbarComponent from "@/components/NavbarComponent.vue";
import FooterComponent from "@/components/FooterComponent.vue";

export default {
    name: "RegisterView",
    components: {
        InscriptionComponent,
        NavbarComponent,
        FooterComponent,
    }
}
</script>

<style scoped>

</style>
