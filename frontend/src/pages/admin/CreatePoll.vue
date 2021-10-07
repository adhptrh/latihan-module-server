<template>
    <div>
        <Navbar />
        <div class="mx-5">
            <div v-if="message.length > 0" class="alert" :class="{'alert-success':successCreated, 'alert-danger':!successCreated}">
                {{message}}
            </div>
            <div class="bg-white p-3 rounded shadow">
                <p class="fw-bold">Create new poll</p>
                <form @submit="submit" class="form-group">
                    <input v-model="form.title" class="form-control mb-3" placeholder="Title" required>
                    <input v-model="form.description" class="form-control mb-3" placeholder="Description" required>
                    <input v-model="form.deadline" class="form-control mb-3" type="datetime-local" placeholder="Deadline" required>
                    <p>Choices</p>
                    <div>
                        <div v-for="choice, index in form.choices" v-bind:key="index" class="mb-3 d-flex">
                            <input v-model="form.choices[index]" @keydown="addNewChoice(index)" class="form-control mb-0" placeholder="Choice" >
                            <button v-if="index > 0" @click="deleteChoice(index)" type="button" class="btn bg-danger py-1 px-3 text-white shadow-sm"><i class="bi-trash"></i></button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "../../components/Navbar.vue"

export default {
    components: {
        Navbar
    },

    data() {
        return {
            form: {
                title:"",
                description:"",
                deadline:"",
                choices:[""]
            },
            successCreated: false,
            message:""
        }
    },

    methods:{
        addNewChoice(e) {
            console.log(e)
            if (e === this.form.choices.length - 1) {
                this.form.choices.push("")
            }
        },

        submit(e) {
            e.preventDefault();
            this.form.choices.pop();
            this.$http({
                url:"poll",
                method:"post",
                data:this.form
            }).then(res=>{
                console.log(res)
                this.message = "Poll created!"
                this.successCreated = true
            }).catch(err=>{
                this.message = "Invalid data"
                this.successCreated = false
            })
        },

        deleteChoice(i) {
            this.form.choices.splice(i,1)
        }
    },

}
</script>