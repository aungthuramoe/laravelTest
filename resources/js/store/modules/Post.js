import router from '../../router/routes'
const state = {
    posts: [],
    post: {},
    test: "Hey Vue"
};
const getters = {
    postLists: state => state.posts
};
const actions = {
    async addPost({ commit }, post) {
        commit("addNewPost", post)
        router.push({
            name:'posts-create-confirm'
        });
    },
};
const mutations = {
    // addNewPost :(state, post) => state.post.unshift(post),
    addNewPost: (state, post) => { state.post = post; }
};

export default {
    state,
    getters,
    actions,
    mutations,
}