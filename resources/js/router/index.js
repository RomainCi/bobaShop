import {createRouter, createWebHistory} from "vue-router";
import HomeView from "../../views/HomeView.vue";
import ContactView from "../../views/ContactView.vue";
import QuiSommesNousView from "../../views/QuiSommesNousView.vue";
import FaqView from "../../views/FaqView.vue";
const routes = [
    {
        path: "/",
        name: "home",
        component: HomeView
    },
    {
        path: "/contact",
        name:"contact",
        component: ContactView
    },
    {
        path:"/qui-sommes-nous",
        name:"qui-sommes-nous",
        component: QuiSommesNousView,
    },
    {
        path:"/FAQ",
        name:"FAQ",
        component: FaqView
    }
]
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router