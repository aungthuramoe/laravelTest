import router from '../../router/routes'
const state = {
    post: {},
};
const actions = {
    async addPost({ commit }, post) {
        commit("addNewPost", post)
        router.push({
            name: 'posts-create-confirm'
        });
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