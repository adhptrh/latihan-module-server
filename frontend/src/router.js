import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from './page/auth/Login.vue'
import App from './App.vue'

Vue.use(VueRouter);

export default new VueRouter({
    history: true,
    mode: 'history',
    routes: [
        {
            path: "/login",
            component: Login,
            meta: {
                auth:false
            }
        },
        {
            path: "/",
            component: App,
            meta: {
                auth:true
            }
        }
    ]
});