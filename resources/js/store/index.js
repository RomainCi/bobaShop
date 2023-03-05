import { createStore } from "vuex";

export default createStore({
    state: {
        nbrBasket: 0,
    },
    getters: {},
    mutations: {
        increment(state, payload) {
            state.nbrBasket = payload;
        },
    },
    actions: {
        ajouterElement({commit},payload) {
            commit('increment', payload)
        }
    },
    modules: {},
});
