import Vuex from 'vuex'

const store = () => new Vuex.Store({
    state: {
        trendPolls: [],
        recentPolls: [],
        detailPoll:[],
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
            this.$axios.$post(`api/question/vote/${voteId}`)
                .then((response) => {
                    //state.popularContents = response.data
                });
            console.log("POST_POLL");
        },
        COUNT_UP_POLL({state}, {key}){
            state.detailPoll.questions[key].vote++;
            state.detailPoll.totalVote++;
        },
        GET_DETAIL_POLL({commit, state, getters},{id}){
            return this.$axios.$get(`api/poll/detail/${id}`)
                .then((response) => {
                    console.log(response.data);
                    state.detailPoll = response.data
                }).catch((response) => {
                    throw new Error("api error");
                });
        },
        GET_RECENT_POLL({commit, state, getters}){
            this.$axios.$get("api/poll/recent")
                .then((response) => {
                    state.recentPolls = response.data
                });
        },
        GET_TREND_POLL({commit, state, getters}){
            this.$axios.$get("api/poll/popular")
                .then((response) => {
                    state.trendPolls = response.data
                });

        },
        CREATE_POLL({commit, state, getters}, data){
            this.$axios.$post("api/poll/create", data)
                .then((response) => {

                });
        }
    }
})

export default store
