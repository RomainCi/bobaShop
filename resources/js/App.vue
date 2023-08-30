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
        // userData: Object,
    },
    components: {
        FooterComponent,
    },
    mounted() {
        // console.log(this.userData);
        // this.$store.dispatch('faux', this.userData);
        this.$store.dispatch('checkAdmin', this.connexionAdmin);
        this.$store.dispatch('checkUser', this.connexionUser);

    },
    methods: {}

}
</script>

<style scoped>

</style>
