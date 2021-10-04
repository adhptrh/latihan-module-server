import bearer from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js'
import axios from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js'
import router from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js'
import authBasic from '@websanova/vue-auth/dist/drivers/auth/basic.esm.js'
// Auth base configuration some of this options
// can be override in method calls
const config = {
  auth: authBasic,
  http: axios,
  router: router,
  tokenDefaultName: 'laravel-vue-spa',
  tokenStore: ['localStorage'],
  rolesVar: 'role',
  loginData: {url: 'http://localhost:8000/api/auth/login', method: 'POST', redirect: '', fetchUser: true},
  logoutData: {url: 'auth/logout', method: 'POST', redirect: '/', makeRequest: true},
  fetchData: {url: 'auth/user', method: 'GET', enabled: true},
}
export default config