import Vue from "vue";
import Vuex from "vuex";

// modules

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        user: [],
        vehicle_movement_barData: {}
    },
    getters: {
        userGet(state) {
            return state.user;
        },
        vehicle_movement_bar_incomingGet(state) {
            return state.vehicle_movement_barData.incoming;
        },
        vehicle_movement_bar_outgoingGet(state) {
            return state.vehicle_movement_barData.outgoing;
        },
    },
    mutations: {
        userMut(state, user) {
            state.user = [];
            if (user !== "logout") {
                state.user.push(user);
            }
        },
        vehicle_movement_barMut(state, data) {
            // state.vehicle_movement_barData = []
            if (data.incoming.length > 0 && data.outgoing.length > 0  ) {
                state.vehicle_movement_barData = data;
            }
        }
    },
    actions: {
        userAct(context, user) {
            context.commit("userMut", user);
        },
        vehicle_movement_barAct(context, data) {
            context.commit('vehicle_movement_barMut', data)
        }
    },
    modules: {},
});

export default store;
