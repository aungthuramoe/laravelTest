import router from '../../router/routes'
const state = {
    post: {},
};
const actions = {
    addPost({ commit }, post) {
        commit("addNewPost", post)
    },
};
const mutations = {
    addNewPost: (state, post) => { state.post = post; },
};

export default {
    state,
    actions,
    mutations,
}