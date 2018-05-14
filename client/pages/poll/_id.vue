<template>
    <div>
        <section class="section">
            <div class="columns  is-multiline is-centered">
                <div class="column is-10">
                    <div>
                        <div class="box">
                            <p>detail</p>
                            <p>id: {{detailPoll.id}}</p>
                            <p>title: {{detailPoll.title}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="columns is-mobile is-multiline is-centered">
                <div v-for="(value, key, index) in detailPoll.qs" :key="index" class="column is-3-desktop is-6-mobile">
                    <a @click="vote">
                        <div class="box half-color-button">
                                <p>detail</p>
                                <p>id: {{value.id}}</p>
                                <p>title: {{value.ask}}</p>
                                <p>vote: {{value.vote}}</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    export default {
        name: "_id",
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
        computed:mapState([
            "detailPoll"
        ]),
        fetch({ store, params }){
            store.dispatch("GET_DETAIL_POLL",{id: params.id})
        },
        methods:{
            vote(){
                console.log("aaaaaaaaaaavote")
            }
        }
    }
</script>

<style scoped>
    .half-color-button{
        background-color: #4098d3;
        color: #fff;
        background-image: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.5) 51%);
    }
</style>