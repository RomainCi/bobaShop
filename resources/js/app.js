import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler.js";
import router from "./router/index";
import store from "./store";
import app from "./App.vue";

const App = createApp(app);
App.use(store)
App.use(router)
App.component('app', app)
App.mount('#app');