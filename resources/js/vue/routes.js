import VueRouter from "vue-router";
// import store from "./store";

import Dashboard from "./components/dashboard.vue";
import Sites from "./components/sites.vue";

const routes = [

    {
        path: "/",
        name: "Dashboard",
        component: Dashboard,
    },
    {
        path: "/sites",
        name: "Sites",
        component: Sites,
    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

router.beforeEach((to, from, next) => {

    // let user = localStorage.user;

    // console.log(user);

    // if (user == undefined && to.path !== "/about") {
    //     next({ path: "/about" });
    // }
    // else next();
});

export default router;
