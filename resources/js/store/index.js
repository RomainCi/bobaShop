import {createStore} from "vuex";

export default createStore({
    state: {
        nbrBasket: 0,
        admin: 0,
    },
    getters: {},
    mutations: {
        increment(state, payload) {
            state.nbrBasket = payload;
        },
        check(state, playAdmin) {
            state.admin = playAdmin
        }
    },
    actions: {
        ajouterElement({commit}, payload) {
            commit('increment', payload)
        },
        checkAdmin({commit}, playAdmin) {
            commit('check', playAdmin)
        }
    },
    modules: {},
});
