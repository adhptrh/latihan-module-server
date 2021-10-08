import Vue from "vue";
import VueRouter from "vue-router";
import Login from "./pages/auth/Login.vue"
import Logout from "./pages/auth/Logout.vue"
import ResetPassword from "./pages/ResetPassword.vue"
import Home from "./pages/Home.vue"
import CreatePoll from "./pages/admin/CreatePoll.vue"
import ViewPoll from "./pages/admin/ViewPoll.vue"
import Vote from "./pages/user/Vote.vue"

Vue.use(VueRouter)

Vue.router = new VueRouter({
    mode:'history',
    routes:[
        {
            path: "/login",
            component: Login,
            name: "Login",
            meta: {
                guard: ["guest"],
                routeDenied: {
                    name:"Home"
                }
            }
        },

        {
            path: "/reset_password",
            component: ResetPassword,
            name: "ResetPassword",
            meta: {
                guard: ["admin", "user"],
                routeDenied: {
                    name:"Home"
                }
            }
        },

        {
            path: "/",
            component: Home,
            name: "Home",
            meta: {
                guard: ["admin", "user"],
                routeDenied: {
                    name:"Login"
                }
            }
        },
        
        {
            path: "/logout",
            component: Logout,
            name: "Logout"
        },
        
        {
            path: "/create_poll",
            component: CreatePoll,
            name: "CreatePoll"
        },
        
        {
            path: "/poll/:id",
            component: ViewPoll,
            name: "ViewPoll"
        },
        
        {
            path: "/vote/:id",
            component: Vote,
            name: "Vote"
        },
    ]
})

Vue.router.beforeEach((to, from, next) => {
    let token = localStorage.getItem("token")
    let role = localStorage.getItem("role") ?? "guest"

    if (to.meta["guard"] && !to.meta.guard.includes(role)) {
        next(to.meta.routeDenied)
    }

    next({});

})
export default Vue.router