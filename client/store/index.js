import Vuex from 'vuex'

const store = () => new Vuex.Store({
    state: {
        trendPolls: [],
        recentPolls: [],
        detailPoll:{},
        votedPolls:[]
    },
    //stateに変更を加えるとき使う
    mutations: {
        /**
         * ローカルストレージに投票済みのPollId, voteidを入れる
         * @param state
         * @param payload
         */
        add_storage(state, payload){
            console.log(state.votedPolls);
            state.votedPolls.push(payload)
        }
    },
    getters:{
        /**
         * 投票IDから投票済みのアンケートを取得
         * @param state
         * @returns {function({id: *})}
         */
        voted_poll:(state) => ({id}) => {
            return state.votedPolls.filter((poll) => poll.pollId == id)
        }
    },
    actions: {
        nuxtClientInit ({ commit, state, dispatch }, { req }) {
            if (localStorage.votedPolls) {
                state.votedPolls = JSON.parse(localStorage.votedPolls)
            }
        },
        SET_POLL_STORAGE({commit, state},{pollId,voteId}){
            commit('add_storage', {pollId:pollId, voteId:voteId})
            localStorage.setItem("votedPolls", JSON.stringify(state.votedPolls));
        },
        POST_POLL({commit, state, getters},{voteId}){
            // this.$axios.$get("api/theme/popular")
            //     .then((response) => {
            //         state.popularContents = response.data
            //     });
            console.log("POST_POLL");
        },
        COUNT_UP_POLL({state}, {key}){
            state.detailPoll.qs[key].vote++;
            state.detailPoll.totalVote++;
        },
        GET_DETAIL_POLL({commit, state, getters},{id}){
            // this.$axios.$get("api/theme/popular")
            //     .then((response) => {
            //         state.popularContents = response.data
            //     });
            console.log(id)
            state.detailPoll =
                {
                    "id":3,
                    "title":"コカコーラと三ツ矢サイダーならどっちが好き？",
                    "totalVote":4,
                    "qs":[
                        {
                            id:222,
                            ask:"コカコーラ",
                            vote: 1
                        },
                        {
                            id:3333,
                            ask:"三ツ矢サイダー",
                            vote:1
                        },
                        {
                            id:4444,
                            ask:"炭酸ならなんでもいい",
                            vote:1
                        },
                        {
                            id:555,
                            ask:"がぶ飲みメロンソーダ",
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
