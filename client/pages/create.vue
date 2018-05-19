<template>
    <section class="section">
        <div class="columns  is-multiline is-centered">
            <div class="column is-10">
                <div class="box">
                    <section class="section">
                        <div class="field">
                            <label class="label is-size-3">Polly Title </label>

                            <div class="control">
                                <input class="input is-large" type="text" name="pollTitle" v-model="postData.title" placeholder="Question.....">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">詳細</label>
                            <div class="control">
                                <input class="input" type="text" v-model="postData.description" placeholder="Text input">
                            </div>
                            <p class="help"></p>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="columns is-multiline is-centered">
            <div v-for="(value, key, index) in postData.questions" :key="index" class="column is-6-desktop is-12-mobile">
                <div class="box">
                    <article class="media">
                        <div class="media-content">
                            <div class="field">
                                <label class="label">Answer {{key + 1}}</label>
                                <div class="control">
                                    <input class="input" type="text" v-model="value.title" placeholder="回答...">
                                </div>
                            </div>
                        </div>
                        <div class="media-right">
                            <button class="delete" @click="deleteQuestion(key)"></button>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <section class="has-text-centered" style="padding-bottom: 24px">
            <a @click="addQuestion">
                <span class="button is-info is-large">回答を増やす</span>
            </a>
        </section>
        <div class="columns  is-multiline is-centered">
            <div class="column is-4">
                <span class="label has-text-danger has-text-centered">{{this.validation.create}}</span>
                <a @click="create">
                    <div class="box">
                        <section class="section">
                            <span class="label is-size-2 has-text-grey-dark has-text-centered">Create</span>
                        </section>
                    </div>
                </a>
            </div>
        </div>
    </section>

</template>

<script>
    import { mapState, mapGetters } from 'vuex'
    export default {
        name: "create",
        head(){
            return {
                title:"",
                meta: [
                    { hid: 'description', name: 'description', content: 'My custom description' }
                ]
            }
        },
        data(){
            return {
                postData: {
                    title: "",
                    description:"",
                    questions:[
                        {
                            "title":null
                        },
                        {
                            "title":null
                        }
                    ]
                },
                validation:{
                    create: ""
                }
            }
        },
        methods:{
            addQuestion(){
                if(this.postData.questions.length == 8){
                    this.$toast.open({
                        duration: 5000,
                        message: `回答を8以上にすることはできません。`,
                        position: 'is-bottom',
                        type: 'is-danger'
                    })
                }else {
                    this.postData.questions.push({
                        "title": null
                    })
                }
            },
            deleteQuestion(key){
                if(this.postData.questions.length <= 2){
                    this.$toast.open({
                        duration: 5000,
                        message: `回答を2以下にすることはできません。`,
                        position: 'is-bottom',
                        type: 'is-danger'
                    })
                }else{
                    this.postData.questions.splice(key, 1);
                }
            },
            async create(){
                await this.$store.dispatch("CREATE_POLL", this.postData).then(() => {
                    this.$router.replace({ path: '/' });
                }).catch(()=>{
                    this.validation.create = "保存できませんでした。エラーがないかお確かめください。"
                });
            }
        }
    }
</script>

<style scoped>

</style>