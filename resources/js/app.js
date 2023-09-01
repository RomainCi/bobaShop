import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler.js";
import router from "./router/index";
import store from "./store";
import app from "./App.vue";
import navbarComponent from "@/components/NavbarComponent.vue";

document.addEventListener('DOMContentLoaded', () => {
    const loadingContainer = document.querySelector('.loading-container-home');
    if (loadingContainer) {
        loadingContainer.style.display = 'none';
    }
    const App = createApp();
    App.component('app', app)
    App.component('navbar-component', navbarComponent)
    App.use(store)
    App.use(router)
    App.mount('#app');
});
