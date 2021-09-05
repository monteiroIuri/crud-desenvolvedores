import Vue from "vue";
import Router from "vue-router";
import DeveloperList from "../components/DeveloperList";
import HelloWorld from "../components/HelloWorld";

Vue.use(Router);

export default new Router({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "developers",
            component: DeveloperList
        },
        {
            path: "/developers",
            name: "developers",
            component: DeveloperList
        },
        {
            path: "/vue",
            name: "vue",
            component: HelloWorld
        },
    ]
})