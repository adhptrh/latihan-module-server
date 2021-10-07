import Vue from 'vue'
import http from './http'
import router from "./route"
import App from './App.vue'

Vue.config.productionTip = false

new Vue({
  el:"#app",
  http,
  router,
  render: h => h(App),
})