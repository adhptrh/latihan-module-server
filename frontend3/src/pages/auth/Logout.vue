<script>

export default {
    mounted() {
        this.$http({
                url:"auth/logout",
                method:"post"
        }).finally(()=>{
            localStorage.clear();
            this.$router.push({name:"Login"})
        })
        
    }
}

</script>