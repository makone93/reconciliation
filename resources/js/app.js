require('./bootstrap');

// ================= IMPORTS =============//
// MODULES IMPORTS
import Vue from 'vue';
import VueRouter from "vue-router";
import App from './vue/App.vue';
import store from './vue/store';
import VueApexCharts from 'vue-apexcharts'


// import Vuetify from "vuetify";
// import "vuetify/dist/vuetify.min.css";

// COMPONENTS IMPORTS
import Home from './vue/components/home.vue';
import Reconcile from './vue/components/reconcile.vue';

// ================= ROUTES =============//
const routes = [
    { path: '/', component: Home },
    { path: '/reconcile', component: Reconcile },
];

const router = new VueRouter({
    mode: 'history',
    routes,
});


// ================= IMPLEMENTATIONS =============//
Vue.prototype.$http = axios;
// Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(VueApexCharts)
Vue.component('apexchart', VueApexCharts);


// ================= MOUNTING =============//
new Vue({
    // vuetify: new Vuetify(),
    el: '#app',
    store: store,
    router,
    render: h => h(App),
});

