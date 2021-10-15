import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";

const config = axios.create({
    baseURL:process.env.VUE_APP_API_URL,
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

config.interceptors.response.use((response) => {
    if(response.status === 401) {
         alert("You are not authorized");
    }
    return response;
}, (error) => {
    if (error.response.status === 401) {
        localStorage.clear()
        localStorage.setItem("error","unauthorized")
        window.location = "/login"
    }
    return Promise.reject(error.message);
});

Vue.use(VueAxios, config)

export default config