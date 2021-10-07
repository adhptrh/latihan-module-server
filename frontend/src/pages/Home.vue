<template>
    <div>
        <Navbar />

        <HomeAdmin v-if="admin === true" />
        <HomeUser v-else/>
    </div>
</template>

<script>
import HomeAdmin from "./admin/Home.vue"
import HomeUser from "./user/Home.vue"
import Navbar from "../components/Navbar.vue"

export default {
    components: {
        HomeAdmin,
        HomeUser,
        Navbar
    },
    data() {
        return {
            admin: (localStorage.getItem("role") === "admin") ? true:false,
            user:[]
        }
    },

    mounted() {
        this.$http({
            url:"auth/me",
            method:"post"
        }).then(res=>{
            this.user = res.data
        })
    },
    
    methods:{
        logout() {
            this.$http({
                url:"auth/logout",
                method:"post"
            }).finally(()=>{
                localStorage.clear();
                this.$router.push({name:"Login"})
            })
        }
    }
}

</script>