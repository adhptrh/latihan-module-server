import Vue from 'vue';

// Vue Resource
// import VueResource from 'vue-resource';

// Vue.use(VueResource);
// Vue.http.options.root = process.env.VUE_APP_API_URL;

// Axios
import axios    from 'axios';
import VueAxios from 'vue-axios';

axios.defaults.baseURL = `http://127.0.0.1:8000/api/`;
Vue.use(VueAxios, axios);
export default {
    root: `http://127.0.0.1:8000/api/`
};