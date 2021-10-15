<template>
    <div class="bg-light d-flex flex-column justify-content-center align-items-center" style="width:100vw; height:100vh;">
        
        <div class="bg-white p-3 shadow text-center fw-bold text-primary" style="min-width:300px;border-radius: 30px 30px 0 0;">
            YukPilih
        </div>
        <div class="bg-white p-3 rounded shadow" style="min-width:400px;">
            <p class="text-primary">Login</p>
            <div v-if="loginFailed" class="alert alert-danger">
                {{failedMessage}}
            </div>
            <form @submit="submit">
                <input class="form-control mb-3" v-model="form.username" placeholder="Username">
                <input class="form-control mb-3" v-model="form.password" placeholder="Password" type="password">
                <button class="btn btn-primary w-100" type="submit" :disabled="submitting">Login</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                username:"",
                password:""
            },
            submitting: false,
            loginFailed: false,
            failedMessage: ""
        }
    },

    mounted() {
        if (localStorage.getItem("error") === "unauthorized") {
            this.loginFailed = true
            this.failedMessage = "Unauthorized"
            localStorage.clear()
        }
    },

    methods: {
        login() {
            this.$http({
                url:`/auth/login`,
                method:"post",
                data:this.form
            }).then((res)=>{
                console.log(res.data)
                localStorage.clear()
                localStorage.setItem("token",res.data.access_token)
                this.me()
            }).catch((err)=>{
                console.log(err.response)
                this.submitting = false
                this.loginFailed = true
                this.failedMessage = err.response.data.error
            })
        },

        submit(e) {
            e.preventDefault()
            this.submitting = true
            this.login()
        },

        me() {
            this.$http({
                url:"auth/me",
                method:"post"
            }).then(res=>{
                console.log(res.data)
                localStorage.setItem("role",res.data.role)
                if (res.data.created_at === res.data.updated_at) {
                    this.$router.push({
                        name:"ResetPassword"
                    })
                    return
                }
                this.$router.push({
                    name:"Home"
                })
            }).catch(err=>{
                this.submitting = false
            })
        }
    }
}
</script>
