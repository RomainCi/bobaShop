import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler.js";
import App from "./App.vue";
import router from "./router/index";

createApp(App)
    .use(router)
    .mount('#app');