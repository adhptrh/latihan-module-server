import Vue from 'vue'

import auth                  from '@websanova/vue-auth/src/auth.js';
import driverAuthBearer      from '@websanova/vue-auth/dist/drivers/auth/bearer.js';
import driverHttpAxios       from '@websanova/vue-auth/dist/drivers/http/axios.1.x.js';
// import driverHttpVueResource from '@websanova/vue-auth/src/drivers/http/vue-resource.1.x.js';
import driverRouterVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.js';

Vue.use(auth, {
    plugins: {
        http: Vue.axios, // Axios
        // http: Vue.http, // Vue Resource
        router: Vue.router,
    },
    drivers: {
        auth: driverAuthBearer,
        http: driverHttpAxios, // Axios
        // http: driverHttpVueResource, // Vue Resource
        router: driverRouterVueRouter
    },
    options: {
        rolesKey: 'type',
        notFoundRedirect: {name: 'user-account'},
    }
});