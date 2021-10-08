<template>
    <div>
        <div class="mx-5 bg-white p-3 rounded shadow">
            <p class="fw-bold">Voting</p>
            <div class="d-flex flex-wrap">
                <button @click="$router.push('vote/'+n.id)" v-for="n in polls" :key="n" style="max-width: 300px;" class="btn p-0 m-2 text-start rounded shadow-sm">
                    <div class="d-flex flex-column">
                        <div class="bg-primary p-3" style="border-radius: 7px 7px 0px 0px;">
                            <p class="fw-bold text-white mb-0">{{shortText(n.title,30)}}</p>
                            <p class="mb-0 text-white">{{shortText(n.description,30)}}</p>
                        </div>
                        <div class="d-flex flex-column bg-white p-2 px-3 rounded">
                            <p class="mb-0 mt-0 text-warning">Deadline - <span class="fw-bold">{{n.deadline}}</span></p>
                            <p class="mb-0 mt-0">Creator - <span class="fw-bold">{{n.creator}}</span></p>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            user:{},
            polls:[]
        }
    },

    mounted() {
        this.getPolls();
    },

    methods: {
        shortText(texts,len) {
            if (texts.length > len) {
                return texts.substring(0,len)+"..."
            }
            return texts
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
