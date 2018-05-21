<template>
    <div>
        <section class="section">
            <div class="columns  is-multiline is-centered">
                <div class="column is-10">
                    <div class="box pollBox">
                        <p class="has-text-grey-dark has-text-centered has-text-weight-bold is-size-1-desktop is-size-4-mobile"><!--
                        -->{{detailPoll.title}}<!--
                        --></p>
                            <p class="has-text-weight-light has-text-right">
                                <span class="has-text-weight-bold is-size-9-mobile is-size-4-desktop">
                                <img src="/id-card.png" style="height: 30px;margin-bottom: -10px;"/>
                                #####</span>
                            </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="columns is-mobile is-multiline is-centered has-text-weight-bold">
                <div v-for="(value, key, index) in detailPoll.questions" :key="index" class="column is-3-desktop is-6-mobile">
                    <div v-if="isVote"
                        class="box flex has-text-centered"
                        v-bind:style="voteColor(value.vote, value.id)"
                    >
                        <p>{{value.title}}</p>
                        <p>{{voteRatio(value.vote)}}%</p>
                    </div>
                    <div class="box flex has-text-centered" v-else @click="vote(value.id); countUp(key)">
                        <p>{{value.title}}</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="level" style="margin-right: 10px">
            <h1 class="level-item has-text-centered has-text-weight-bold is-size-3"><img src="/badge.png" style="height: 40px; margin-bottom: -10px"/>{{detailPoll.totalVote}} vote</h1>
        </section>
    </div>
</template>

<style scoped>
.pollBox{
    background-color: #FFFCFC
}
.flex {
    /*display: flex;*/
    /*width: 100%;*/
    height: 100%;
}
</style>

<script>
    import { mapState, mapGetters } from 'vuex'
    export default {
        name: "_id",
        data(){
            return{
                isVote: false,
                votedId:0,
                metaTitle:""
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
                    { hid: 'description', name: 'description', content: '投票しよう！' },
                    { hid: 'twitter:description', name: 'twitter:description', content: '投票しよう！' },
                    { hid: 'twitter:title', name: 'twitter:title', content: `${this.detailPoll.title}に投票しよう。Polly-投票箱-` },
                    { hid: 'og:url', name: 'og:url', content: `${this.$nuxt.$route.fullPath}` },
                    { hid: 'og:image', name: 'og:image', content: `${process.env.apiUrl}/poll_img/${this.detailPoll.id}.jpg` },
                    { hid: 'twitter:url', name: 'twitter:url', content: `${this.$nuxt.$route.fullPath}` },
                    { hid: 'twitter:image', name: 'twitter:image', content: `${process.env.apiUrl}/poll_img/${this.detailPoll.id}.jpg` },

                ]
            }
        },
        computed:{
            ...mapState([
                         "detailPoll"
                     ])
        },
        async asyncData({ store, params, error }){
            return await store.dispatch("GET_DETAIL_POLL",{id: params.id}).catch(()=>{
                error({ statusCode: 404, message: 'Post not found' });
            })
        },
        mounted(){
            //storageに投票データがあれば投票済みにする。
            const voted = this.$store.getters.voted_poll({id: this.detailPoll.id})
            this.isVote = voted.length > 0?true:false;
            this.votedId = voted.length > 0?voted.shift().voteId:0;
        },
        methods:{
            vote(id){
                this.isVote = true;
                this.votedId = id;
                this.$store.dispatch("POST_POLL", {voteId:id})
                this.$store.dispatch("SET_POLL_STORAGE", {pollId: this.detailPoll.id ,voteId:id})
            },
            countUp(key){
                this.$store.dispatch("COUNT_UP_POLL", {key:key})
            },
            voteRatio(vote){
                return Math.round((vote / this.detailPoll.totalVote) * 100)
            },
            voteColor(val, vId){
                console.debug("voteColor", this.votedId, val, vId)
                if(this.votedId == vId){
                    return { backgroundImage: 'linear-gradient(to right, rgb(255, 106, 0) 0%, rgb(255, 106, 0) '+this.voteRatio(val)+'%,rgba(255,255,255,0) '+this.voteRatio(val)+'%)' }
                }else{
                    return { backgroundImage: 'linear-gradient(to right, rgba(65, 73, 92, 0.7) 0%, rgba(65, 73, 92, 0.7) '+this.voteRatio(val)+'%,rgba(255,255,255,0) '+this.voteRatio(val)+'%)' }
                }
            }
        }
    }
</script>

