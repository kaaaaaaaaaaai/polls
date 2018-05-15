import Vuex from 'vuex'

const store = () => new Vuex.Store({
    state: {
        trendPolls: [],
        recentPolls: [],
        detailPoll:{}
    },
    mutations: {
    },
    getters:{
    },
    actions: {
        POST_POLL({commit, state, getters},{voteId}){
            // this.$axios.$get("api/theme/popular")
            //     .then((response) => {
            //         state.popularContents = response.data
            //     });
            console.log("POST_POLL");
        },
        COUNT_UP_POLL({state}, {key}){
            state.detailPoll.qs[key].vote++
            state.detailPoll.totalVote++
        },
        GET_DETAIL_POLL({commit, state, getters},{id}){
            // this.$axios.$get("api/theme/popular")
            //     .then((response) => {
            //         state.popularContents = response.data
            //     });
            console.log(id)
            state.detailPoll =
                {
                    "id":9999999,
                    "title":"this is detail",
                    "totalVote":4,
                    "qs":[
                        {
                            id:222,
                            ask:"korekroe",
                            vote: 1
                        },
                        {
                            id:3333,
                            ask:"qwqwqwqw",
                            vote:1
                        },
                        {
                            id:4444,
                            ask:"tytytytyty",
                            vote:1
                        },
                        {
                            id:555,
                            ask:"nmnmnmnmn",
                            vote:1
                        },
                    ]
                };
        },
        GET_RECENT_POLL({commit, state, getters}){
            // this.$axios.$get("api/theme/popular")
            //     .then((response) => {
            //         state.popularContents = response.data
            //     });
            state.recentPolls = [
                {
                    "id":1,
                    "title":"wdwdwd"
                }];
        },
        GET_TREND_POLL({commit, state, getters}){
            // this.$axios.$get("api/theme/popular")
            //     .then((response) => {
            //         state.popularContents = response.data
            //     });
            state.trendPolls = [
                {
                    "id":1,
                    "title":"aaaa"
                },
                {
                    "id":2,
                    "title":"aaaa2"
                },
                {
                    "id":3,
                    "title":"aaaa3"
                },
                {
                    "id":4,
                    "title":"aaa4a"
                },{
                    "id":5,
                    "title":"aaa55a"
                },{
                    "id":6,
                    "title":"aaa666a"
                },{
                    "id":6,
                    "title":"aaa666a"
                },{
                    "id":6,
                    "title":"aaa666a"
                },{
                    "id":6,
                    "title":"aaa666a"
                },{
                    "id":6,
                    "title":"aaa666a"
                },{
                    "id":6,
                    "title":"aaa666a"
                },{
                    "id":6,
                    "title":"aaa666a"
                }
            ]
        }
    }
})

export default store
