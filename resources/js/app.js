import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler.js";
import App from "./App.vue";
import router from "./router/index";
import store from "@/store";

createApp(App)
    .use(store)
    .use(router)
    .mount('#app');