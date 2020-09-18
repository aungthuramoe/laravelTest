import router from '../../router/routes'
const state = {
    users: [],
    user: {},
    currentUser:{},
    isLogin:false
};

const getters = {
    usersList: state => state.users
};

const actions = {
    addUser({ commit }, user) {
        commit("addNewUser", user)
        router.push({
            name: 'users-create-confirm'
        });
    },
    isLogin({ commit }, {isLogin,currentUser}) {
        commit('isLogin', {isLogin,currentUser});
        router.push({
            name: 'posts'
        })
    }
};

const mutations = {
    addNewUser: (state, user) => { state.user = user; },
    isLogin: (state,{isLogin,currentUser}) => {state.isLogin = isLogin;state.currentUser = currentUser}
};

export default {
    state,
    getters,
    actions,
    mutations
}