<template>
    <div>
        <section class="section">
            <div class="columns  is-multiline is-centered">
                <div class="column is-10">
                    <div class="box pollBox">
                        <p class="is-size-1	has-text-grey-dark has-text-centered has-text-weight-bold"><!--
                        -->{{detailPoll.title}}<!--
                        --></p>
                            <p class="has-text-weight-light has-text-right">
                                <img src="/id-card.png" style="height: 26px"/>
                                id:{{detailPoll.id}}
                            </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="columns is-mobile is-multiline is-centered">
                <div v-for="(value, key, index) in detailPoll.qs" :key="index" class="column is-3-desktop is-6-mobile">
                    <div
                        v-if="isVote"
                        class="box"
                        v-bind:style="{ backgroundImage: 'linear-gradient(to right, rgb(255, 106, 0) 0%, rgb(255, 106, 0) '+voteRatio(value.vote)+'%,rgba(255,255,255,0) '+voteRatio(value.vote)+'%)' }">
                        <p>id: {{value.id}}</p>
                        <p>title: {{value.ask}}</p>
                        <p>vote: {{value.vote}}</p>
                        <p>ratio: {{voteRatio(value.vote)}}%</p>
                    </div>
                    <a v-else @click="vote(value.id); countUp(key)" >
                        <div class="box">
                            <p>title: {{value.ask}}</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>
.pollBox{
    background-color: #FFFCFC
}
</style>

<script>
    import { mapState } from 'vuex'
    export default {
        name: "_id",
        data(){
            return{
                isVote: false
            }
        },
        validate ({ params }) {
            // 数値でなければならない
            return /^\d+$/.test(params.id)
        },
        head () {
            return {
                title: this.detailPoll.title,
                meta: [
                    { hid: 'description', name: 'description', content: 'My custom description' }
                ]
            }
        },
        computed:{
            ...mapState([
                         "detailPoll"
                     ]),
        },
        fetch({ store, params }){
            store.dispatch("GET_DETAIL_POLL",{id: params.id})
        },
        methods:{
            vote(id){
                this.isVote = true;
                console.log(id);
                this.$store.dispatch("POST_POLL", {voteId:id})
            },
            countUp(key){
                this.$store.dispatch("COUNT_UP_POLL", {key:key})
            },
            voteRatio(vote){
                console.log("call ratio")
                return Math.round((vote / this.detailPoll.totalVote) * 100)
            }
        }
    }
</script>

