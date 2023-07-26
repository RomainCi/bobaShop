import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler.js";
import router from "./router/index";
import store from "./store";
import app from "./App.vue";
import navbarComponent from "@/components/NavbarComponent.vue";
// import contentTeaComponent from "@/components/ContentTeaComponent.vue";

const App = createApp();
App.component('app', app)
App.component('navbar-component',navbarComponent)
// App.component('content-tea-component',contentTeaComponent);
App.use(store)
App.use(router)
App.mount('#app');