const state = {
    user: {},
    currentUser:{},
    updateUser:{},
    isLogin:false
};
const actions = {
    addUser({ commit }, user) {
        commit("addNewUser", user)
    },
    updateUser({commit},updateUser){
        commit("updateUser", updateUser)
    },
    addUpdateUserToCurrentUser({commit},user){
        commit('addUpdateUserToCurrentUser',user);
    },
    isLogin({ commit }, {isLogin,currentUser}) {
        commit('isLogin', {isLogin,currentUser});
    }
};

const mutations = {
    addNewUser: (state, user) => { state.user = user; },
    updateUser: (state, user) => { state.updateUser = user},
    addUpdateUserToCurrentUser:(state,user) => {state.currentUser = user},
    isLogin: (state,{isLogin,currentUser}) => {state.isLogin = isLogin;state.currentUser = currentUser}
};

export default {
    state,
    actions,
    mutations
}