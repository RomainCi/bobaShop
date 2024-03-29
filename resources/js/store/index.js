import {createStore} from "vuex";

export default createStore({
    state: {
        nbrBasket: 0,
        admin: 0,
        user: 0,
        faux: null,
    },

    mutations: {
        increment(state, payload) {
            state.nbrBasket = payload;
        },
        check(state, playAdmin) {
            state.admin = playAdmin
        },
        checkUser(state, playUser) {
            state.user = playUser
        },
        // faux(state, playFaux) {
        //     state.faux = playFaux
        // }

    },
    actions: {
        ajouterElement({commit}, payload) {
            commit('increment', payload)
        },
        checkAdmin({commit}, playAdmin) {
            commit('check', playAdmin)
        },
        checkUser({commit}, playUser) {
            commit('checkUser', playUser)
        },
        // faux({commit}, playFaux) {
        //     commit('faux', playFaux);
        // }

    },
    modules: {},
});
