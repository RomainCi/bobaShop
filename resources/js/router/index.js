import {createRouter, createWebHistory} from "vue-router";


import store from '@/store';


const routes = [
    {
        path: "/",
        name: "home",
        component: () => import("../../views/HomeView.vue")
    },
    {
        path: "/contact",
        name: "contact",
        component: ()=> import("../../views/ContactView.vue")
    },
    {
        path: "/qui-sommes-nous",
        name: "qui-sommes-nous",
        component: ()=> import("../../views/QuiSommesNousView.vue")
    },
    {
        path: "/FAQ",
        name: "FAQ",
        component: ()=>import("../../views/FaqView.vue")
    },
    {
        path: "/admin/panel",
        name: "adminPanel",
        meta: {requiresAuth: true},
        component: ()=>import("../../views/AdminPanelView.vue")
    },

    {
        path: "/authentification",
        name: "authentification",
        component: ()=>import("../../views/ConnexionView.vue"),
    },
    {
        path: "/inscription",
        name: "inscription",
        component: ()=>import("../../views/RegisterView.vue"),
    },
    {
        path: "/panier",
        name: "panier",
        component: ()=>import("../../views/BasketView.vue"),
    },
    {
        path: "/compte",
        name: "compte",
        component: ()=>import("../../views/UserView.vue"),
    },
    {
        path: '/update/email/:id&:token',
        name: 'updateEmail',
        component: () => import("../../views/HomeView.vue")
    },
    {
        path: '/confirmation/email/:id&:token',
        name: 'confirmationEmail',
        component: () => import("../../views/HomeView.vue")
    },
    {
        path: '/commandes/:id',
        name: "commandesShow",
        props: true,
        component:()=>import("../../views/PaymentView.vue"),
    },
    {
        path: '/password/:token',
        name: "passwordReset",
        props: true,
        component: ()=>import("../../views/RegisterView.vue"),
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
