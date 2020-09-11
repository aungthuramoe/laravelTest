const state = {
    posts:[],
    post:{
        title:'',
        description:'',
    },
    title: 'Testing Vuex hey',
};
const getters = {
    postLists: state => state.posts
};
const actions = {

};
const mutations = {

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}