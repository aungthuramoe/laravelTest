import Vue from 'vue'
import Vuex from 'vuex'
import UsersModule from '../store/modules/User'
import PostsModule from '../store/modules/Post'
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

const store = new Vuex.Store({
    modules:{
        UsersModule,
        PostsModule,
    },
    plugins: [createPersistedState()],
    strict: true,
})

export default store;