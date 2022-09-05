import Vue from 'vue'
import VueRouter from "vue-router";
import vuetify from './plugins/vuetify'
import App from './components/App'
import Home from "./components/Home";
import AddArticle from "./components/AddArticle";

Vue.use(VueRouter);
window.axios = require('axios');

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
            meta: {
                title: "Articles",
            },
        },
        {
            path: "/add",
            name: "add",
            component: AddArticle,
            meta: {
                title: "Add new article",
            },
        }
    ]
});

new Vue({
    vuetify,
    router,

    render: (h) => h(App),
}).$mount('#app')
