<template>
    <div class="mx-5">
        <button class="btn btn-primary fw-bold" @click="(()=>{this.$router.push('/create_poll')})" style="border-radius: 14px 14px 0 0;">Create New Poll</button>
        <div class="bg-white p-3 rounded shadow">
            <p class="fw-bold">Your Polls</p>
            <div class="d-flex flex-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Deadline</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="n,index in polls" :key="index">
                            <td>{{shortText(n.title,30)}}</td>
                            <td>{{shortText(n.description,30)}}</td>
                            <td :class='[(new Date() > new Date(n.deadline)) ? "text-danger":"text-success"]'>{{n.deadline}}</td>
                            <td>
                                <button @click="$router.push('poll/'+n.id)" class="btn btn-primary">Results</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p v-if="pollsLoading">Loading polls...</p>
                <p v-if="!pollsLoading && polls.length < 1">You dont have any polls, create one.</p>
                <!-- <div v-for="n,index in polls" :key="index" style="max-width: 300px;" class="p-0 m-2 text-start rounded shadow-sm">
                    <div class="d-flex flex-column">
                        <button @click="$router.push('/poll/'+n.id)" class="btn text-start bg-primary p-3" style="border-radius: 7px 7px 0px 0px;">
                            <p class="fw-bold text-white mb-0">{{shortText(n.title,30)}}</p>
                            <p class="mb-0 text-white">{{shortText(n.description,30)}}</p>
                        </button>
                        <div class="d-flex flex-column bg-white p-2 px-3 rounded">
                            <p class="mb-0 mt-0">Creator: <span class="fw-bold">{{n.creator}}</span></p>
                            <div class="d-flex justify-content-end">
                                <button @click="deletePoll(n.id)" class="btn ms-3 p-0"><i class="bi-trash text-danger"></i></button>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            polls:[],
            user:{},
            pollsLoading:true
        }
    },

    mounted() {
        this.getPolls()
    },

    methods: {
        shortText(texts,len) {
            if (texts.length > len) {
                return texts.substring(0,len)+"..."
            }
            return texts
        },

        deletePoll(id) {
            this.$http({
                url:"poll/"+id,
                method:"delete"
            }).then(res=>{
                this.getPolls()
            })
        },

        getPolls() {
            
            this.$http({
                url:"poll",
                method:"get"
            }).then(res=>{
                this.polls = res.data
                this.pollsLoading = false
            })
        },
    }
}

</script>
