<template>
    <div>
        <p>Reset Password</p>
        <form @submit="submit">
            <input v-model="form.old_password">
            <input v-model="form.new_password">
            <button type="submit">Reset Password</button>
        </form>
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
            }
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
                this.$router.push({name:"Logout"})
            }).catch(err=>{
                console.log(err.response)
            })
        }
    }
}
</script>
