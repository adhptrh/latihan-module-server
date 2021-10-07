import 'es6-promise/auto'
import Vue from 'vue'
import http from './http.js'
import store from './storage'
import router from "./router.js"
import auth from './auth.js'

import App from './App.vue'
Vue.config.productionTip = false
new Vue({
  el: '#app',
  http,
  store,
  router,
  auth,
  render: h => h(App),
})