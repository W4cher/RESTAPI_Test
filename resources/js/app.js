require("./bootstrap");
window.Vue = require("vue");

import VueRouter from "vue-router";

Vue.use(VueRouter);

import App from "./App.vue";
import Home from "../js/components/Home.vue";
import Tasks from "../js/components/Tasks/index.vue";
import TaskShow from "../js/components/Tasks/show.vue";

import VueAxios from "vue-axios";

import Axios from "axios";
import Vue from "vue";

Vue.use(VueAxios, axios);
// Vue.component("Navbar", Navbar)

const routes = [
    {
        name: "/",
        path: "/",
        component: Home,
    },
    {
        name: "taskIndex",
        path: "/tasks",
        component: Tasks,
    },
    {
        name: "taskShow",
        path: "/tasks/:id",
        component: TaskShow,
    },
];

const router = new VueRouter({ mode: "history", routes: routes });
const app = new Vue(Vue.util.extend({ router }, App)).$mount("#app");
