import {createRouter, createWebHistory} from "vue-router";
import {defineAsyncComponent} from "vue";

const HomeView = defineAsyncComponent(() => import("../../views/HomeView.vue"));
const ContactView = defineAsyncComponent(() => import("../../views/ContactView.vue"));
const QuiSommesNousView = defineAsyncComponent(() => import("../../views/QuiSommesNousView.vue"));
const FaqView = defineAsyncComponent(() => import("../../views/FaqView.vue"));
const ConnexionView = defineAsyncComponent(() => import("../../views/ConnexionView.vue"));
const RegisterView = defineAsyncComponent(() => import("../../views/RegisterView.vue"));
const BasketView = defineAsyncComponent(() => import("../../views/BasketView.vue"));
const AdminPanelView = defineAsyncComponent(() => import("../../views/AdminPanelView.vue"));
const UserView = defineAsyncComponent(() => import("../../views/UserView.vue"));
const PaymentView = defineAsyncComponent(() => import("../../views/PaymentView.vue"));
const ResetPasswordView = defineAsyncComponent(() => import("../../views/ResetPasswordView.vue"));
import store from '@/store';


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
    {
        path: "/admin/panel",
        name: "adminPanel",
        meta: {requiresAuth: true},
        component: AdminPanelView,
    },

    {
        path: "/authentification",
        name: "authentification",
        component: ConnexionView,
    },
    {
        path: "/inscription",
        name: "inscription",
        component: RegisterView,
    },
    {
        path: "/panier",
        name: "panier",
        component: BasketView,
    },
    {
        path: "/compte",
        name: "compte",
        component: UserView,
    },
    {
        path: '/update/email/:id&:token',
        name: 'updateEmail',
        component: HomeView,
    },
    {
        path: '/confirmation/email/:id&:token',
        name: 'confirmationEmail',
        component: HomeView,
    },
    {
        path: '/commandes/:id',
        name: "commandesShow",
        props: true,
        component: PaymentView,
    },
    {
        path: '/password/:token',
        name: "passwordReset",
        props: true,
        component: ResetPasswordView,
    }

]
const router = createRouter({
    history: createWebHistory(),
    routes,

});
const isAuthenticated = () => {
    return store.state.admin;
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // si la route nécessite une authentification, vérifiez si l'utilisateur est authentifié
        if (!isAuthenticated()) {
            // si l'utilisateur n'est pas authentifié, redirigez-le vers la page de connexion
            next({
                path: '/authentification',
                query: {redirect: to.fullPath}
            })
        } else {
            // si l'utilisateur est authentifié, continuez la navigation
            next()
        }
    } else {
        // si la route ne nécessite pas d'authentification, continuez la navigation
        next()
    }
})
// router.beforeEach((to, from, next) => {
//     const requiresAuth = to.matched.some(record => record.meta.requiresAuth)
//     const isAdmin = store.state.admin;
//     console.log(isAdmin);
//     if (requiresAuth && !isAdmin) {
//         next('/authentification')
//     } else {
//         next()
//     }
// })

export default router
