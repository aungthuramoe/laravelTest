import Vue from 'vue'
import Vuex, { Store } from 'vuex'
import UsersModule from '../store/modules/User'
import PostsModule from '../store/modules/Post'

Vue.use(Vuex);

const store = new Vuex.Store({
    modules:{
        UsersModule,
        PostsModule
    },
    strict: true,
})

export default store;