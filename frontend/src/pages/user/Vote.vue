<template>
    <div>
        <Navbar />
        <div class="mx-5">
            <div class="bg-white p-3 rounded shadow">
                <p class="fw-bold">{{(pollData.title) ? pollData.title:"Loading..." }}</p>
                <p>Vote Result</p>
                <div v-if="doneVote === false">
                    <div v-for="choice, index in pollData.choices" :key="index">
                        <button @click="vote(choice.id)" class="btn w-100 text-left bg-light rounded mb-3">
                            <p class="m-0 position-absolute ms-3 fw-bold" style="top:4px">{{`${choice.choice} `}}</p>
                            <div class="bg-light py-3 rounded overflow-hidden" :style='{"width":"100%"}'>
                                <p class="m-0 ms-3 position-absolute text-black fw-bold" style="top:4px">{{`${choice.choice} `}}</p>
                            </div>
                        </button>
                    </div>
                </div>
                <div v-else>
                    <div v-for="choice, index in pollData.result" :key="index">
                        <div class="bg-light rounded mb-3">
                            <p class="m-0 position-absolute ms-3 fw-bold" style="top:4px">{{`${choice.choice} (${choice.point}%)`}}</p>
                            <div class="bg-primary py-3 rounded overflow-hidden" :style='{"width":choice.point+"%"}'>
                                <p class="m-0 ms-3 position-absolute text-white fw-bold" style="top:4px">{{`${choice.choice} (${choice.point}%)`}}</p>
                            </div>
                        </div>
                    </div>
                </div>
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
            pollId: this.$route.params.id,
            pollName: "Poll Name",
            pollData: {},
            doneVote: false,
        }
    },

    mounted() {
        this.getPollData()
    },

    methods: {
        getPollData() {
            this.$http({
                url:`poll/${this.pollId}`,
                method:"get"
            }).then(res=>{
                console.log(res.data)
                this.pollData = res.data
                if (res.data["result"]) {
                    this.doneVote = true
                }
            })
        },

        vote(id) {
            this.$http({
                url:`poll/${this.pollId}/vote/${id}`,
                method:"post"
            }).then(res=>{
                this.getPollData()
            })
        }
    }

    
}


</script>