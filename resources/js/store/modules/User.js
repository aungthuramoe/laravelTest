import axios from 'axios'
import router from '../../router/routes'
const state = {
    users: [],
    user: {},
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
    isLogin({ commit }, val) {
        commit('isLogin', val);
        router.push({
            name: 'posts'
        })
    }
};

const mutations = {
    addNewUser: (state, user) => { state.user = user; },
    isLogin: (state,val) => {state.isLogin = val}
};

export default {
    state,
    getters,
    actions,
    mutations
}