import Vue from 'vue'
import VueAuth from '@websanova/vue-auth/dist/vue-auth.esm.js';
import bearer from '@websanova/vue-auth/dist/drivers/auth/bearer.esm'
import axios from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm';
import router from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm';

// Auth base configuration some of this options
// can be override in method calls
Vue.use(VueAuth,{
    plugins: {
        http: Vue.axios, // Axios
        router: Vue.router,
    },
    drivers: {
    auth: bearer, 
    http: axios,
    router: router,
    tokenDefaultName: 'access_token',
    tokenStore: ['localStorage'],
    registerData: {url: 'auth/register', method: 'POST', redirect: '/login'},
    loginData: {url: 'auth/login', method: 'POST', redirect: '', fetchUser: true},
    logoutData: {url: 'auth/logout', method: 'POST', redirect: '/login', makeRequest: true},
    fetchData: {url: 'auth/me', method: 'GET', enabled: true},
    // refreshData: {url: 'auth/refresh', method: 'GET', enabled: true, interval:30 },
    authRedirect: { path: '/' },
    parseUserData(response){
        let data = response.data;
        // data.refresh = response.refresh_token;
        localStorage.setItem("user", JSON.stringify(data));
        return data;
    }
},
    options: {
        rolesKey: 'role',
        notFoundRedirect: {name: 'user-account'},
    }

});

export default {}