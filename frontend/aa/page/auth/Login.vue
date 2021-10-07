<template>
    <div class="text-center">
        <br/>

        <div class="input-group">
            <input
                v-model="form.body.username"
                placeholder="username"
                type="text"
            />

            <div>{{ form.errors.username }}</div>
        </div>

        <br/>

        <div class="input-group">
            <input
                v-model="form.body.password"
                placeholder="Password"
                type="password"
            />

            <div>{{ form.errors.password }}</div>
        </div>

        <br/>

        <div class="input-group">
            <input
                v-model="form.remember"
                type="checkbox"
            />

            Remember Me

            <div />
        </div>

        <br/>

        <div class="input-group">
            <input
                v-model="form.staySignedIn"
                type="checkbox"
            />

            Stay Signed In

            <div />
        </div>

        <br/>
        
        <div class="input-group">
            <input
                v-model="form.fetchUser"
                type="checkbox"
            />

            Fetch User

            <div />
        </div>
        
        <br/>
        <button @click="loginDefault">
            Default
        </button>

    </div>
</template>
<script>
  export default {
    data() {
            return {
                form: {
                    body: {
                        username: 'admin',
                        password: 'admin',
                    },
                    remember: false,
                    fetchUser: true,
                    staySignedIn: false,
                    errors: {}
                }
            }
    },
    mounted() {
      //
    },
    methods: {
      login() {
        // get the redirect object
        var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          params: {
            username: app.username,
            password: app.password
          },
          success: function() {
            // handle redirection
            console.log('aa');
            // const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === "" ? console.log("admin") : console.log("user")
            
            // this.$router.push({name: redirectTo})
          },
          error: function() {
            app.has_error = true
          },
          rememberMe: true
        })
      },
      loginDefault() {
                this.$auth
                    .login({
                        body: this.form.body, // VueResource
                        data: this.form.body, // Axios
                        remember: this.form.remember ? '{"name": "Default"}' : null,
                        fetchUser: this.form.fetchUser,
                        staySignedIn: this.form.staySignedIn,
                    })
                    .then(null, (res) => {
                        this.errors(
                            res.response || // Axios
                            res             // VueResource
                        );
                    });
            },
    }
  }
</script>