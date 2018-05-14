<template>
    <div>
        detail
        id: {{detailPoll.id}}
        title: {{detailPoll.title}}
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
        async fetch({ store, params }){
            await store.dispatch("GET_DETAIL_POLL",{id: params.id})
        }
    }
</script>

<style scoped>

</style>