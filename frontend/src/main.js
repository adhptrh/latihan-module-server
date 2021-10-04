import Vue from 'vue'
import App from './App.vue'
import router from "./router.js"
import axios from "axios"
import VueAxios from "vue-axios"
import VueAuth from '@websanova/vue-auth/dist/v2/vue-auth.esm.js';
import auth from './auth.js'
import VueRouter from "vue-router"
window.Vue = Vue 
Vue.router = router
Vue.use(VueRouter)

Vue.use(VueAxios, axios)
axios.defaults.baseURL = `http://localhost:8000/api`
Vue.use(VueAuth, auth)

Vue.config.productionTip = false
new Vue({
  render: h => h(App),
  router
}).$mount('#app')
  