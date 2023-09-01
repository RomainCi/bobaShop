<template>
    <div class="main-container">
        <header>
            <navbar-component></navbar-component>
        </header>
        <main>
            <connexion-component></connexion-component>
        </main>
        <footer class="footer">
            <footer-component></footer-component>
        </footer>
    </div>
</template>

<script>
import ConnexionComponent from "../js/components/connexion/ConnexionComponent.vue";
import NavbarComponent from "../js/components/NavbarComponent.vue";
import FooterComponent from "@/components/FooterComponent.vue";

export default {
    name: "ConnexionView",
    components: {
        ConnexionComponent,
        NavbarComponent,
        FooterComponent,
    }
}
</script>

<style scoped>
.main-container{
    height: 110vh;
    display: flex;
    flex-direction: column;
}
main {
    flex: 1; /* Utilise tout l'espace disponible sauf le footer */
}
.footer {
    flex-shrink: 0; /* Empêche le footer de réduire l'espace disponible */
    /* Vous pouvez ajouter d'autres styles au footer ici si nécessaire */
}

</style>
