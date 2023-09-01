<template>
    <router-view></router-view>
</template>

<script>

import FooterComponent from "./components/FooterComponent.vue";

export default {
    name: "App",
    props: {
        connexionAdmin: Boolean,
        connexionUser: Boolean,
    },
    components: {
        FooterComponent,
    },
    mounted() {
        this.$store.dispatch('checkAdmin', this.connexionAdmin);
        this.$store.dispatch('checkUser', this.connexionUser);

    },
    methods: {}

}
</script>

<style scoped>

</style>
