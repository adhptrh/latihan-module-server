<template>
    <div class="bg-light d-flex flex-column justify-content-center align-items-center" style="width:100vw; height:100vh;">
        
        <div class="bg-white p-3 shadow text-center fw-bold text-primary" style="min-width:300px;border-radius: 30px 30px 0 0;">
            YukPilih
        </div>
        <div class="bg-white p-3 rounded shadow" style="min-width:400px;">
            <p class="text-primary">Reset Password</p>
            <div v-if="message.length > 0" class="alert" :class="{'alert-success':!resetFailed,'alert-danger':resetFailed}">
                {{message}}
            </div>
            <form @submit="submit">
                <input class="form-control mb-3" v-model="form.new_password" placeholder="Old Password">
                <input class="form-control mb-3" v-model="form.old_password" placeholder="New Password" type="password">
                <button class="btn btn-primary w-100" type="submit" :disabled="submitting">Reset Password</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name:'ResetPassword',
    data() {
        return {
            form: {
                old_password:"",
                new_password:""
            },
            resetFailed: false,
            message: ""
        }
    },

    methods: {
        submit(e) {
            e.preventDefault();

            this.$http({
                url:"auth/reset_password",
                method: "post",
                data: this.form
            }).then(res=>{
                this.resetFailed = false
                this.message = "Password successfully resetted, please log in again... logging out in 3 seconds"
                setTimeout(()=>{
                    this.logout()
                },3000)
            }).catch(err=>{
                this.resetFailed = true
                this.message = err.response.data.message
                console.log(err.response)
            })
        },

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
