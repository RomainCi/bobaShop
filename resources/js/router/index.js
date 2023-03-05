import {createRouter, createWebHistory} from "vue-router";
import HomeView from "../../views/HomeView.vue";
import ContactView from "../../views/ContactView.vue";
import QuiSommesNousView from "../../views/QuiSommesNousView.vue";
import FaqView from "../../views/FaqView.vue";
import OrdersView from "../../views/OrdersView.vue";
import ConnexionView from "../../views/ConnexionView.vue";
import RegisterView from "../../views/RegisterView.vue";
import BasketView from "../../views/BasketView.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: HomeView
    },
    {
        path: "/contact",
        name: "contact",
        component: ContactView
    },
    {
        path: "/qui-sommes-nous",
        name: "qui-sommes-nous",
        component: QuiSommesNousView,
    },
    {
        path: "/FAQ",
        name: "FAQ",
        component: FaqView
    },
    // {
    //     path: "/commandes",
    //     name: "commandes",
    //     component: OrdersView,
    // },
    // {
    //     path: "/authentification",
    //     name: "authentification",
    //     component: ConnexionView,
    // },
    // {
    //     path:"/inscription",
    //     name:"inscription",
    //     component: RegisterView,
    // },
    // {
    //     path:"/panier",
    //     name:"panier",
    //     component: BasketView,
    // }

]
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router