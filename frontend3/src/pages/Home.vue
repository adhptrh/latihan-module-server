<template>
    <div>
        <div class="w-100 position-fixed d-flex p-3 bg-white shadow" style="z-index:1;border-radius: 0px 0px 15px 15px;">
            <h3 class="fw-bold text-primary">YukPilih</h3>
            <div class="ms-auto d-flex align-items-center">
                <p class="mb-0 me-3">Halo, <span class="fw-bold">{{user.username}}</span></p>
                <button @click="logout" class="btn btn-danger">Logout</button>
            </div>
        </div>
        <div class="pb-5 mb-5"></div>
        <div class="pb-3"></div>

        <HomeAdmin v-if="admin === true" />
        <HomeUser v-else/>
    </div>
</template>

<script>
import HomeAdmin from "./admin/Home.vue"
import HomeUser from "./user/Home.vue"

export default {
    components: {
        HomeAdmin,
        HomeUser
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