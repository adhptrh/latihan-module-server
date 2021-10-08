import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";

const config = axios.create({
    baseURL:"http://localhost:8000/api/",
    timeout:30000
})

config.interceptors.request.use(
    config=>{
        let token = localStorage.getItem("token")
        if (token) {
            config.headers.Authorization = "Bearer "+token
        } else {
            config.headers.Authorization = ""
        }
        return config
    },
    error => Promise.reject(error)
)


Vue.use(VueAxios, config)

export default config