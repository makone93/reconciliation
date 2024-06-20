import Vue from "vue";
import Vuex from "vuex";

// modules

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        user: [],
    },
    getters: {
        userGet(state) {
            return state.user;
        },
    },
    mutations: {
        userMut(state, user) {
            state.user = [];
            if (user !== "logout") {
                state.user.push(user);
            }
        },
    },
    actions: {
        userAct(context, user) {
            context.commit("userMut", user);
        },
    },
    modules: {},
});

export default store;
