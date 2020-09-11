import Vue from 'vue';
import Router from 'vue-router';
import AddPost from '../components/Post/AddPost.vue';
import AllPost from '../components/Post/AllPost.vue';
import AddUser from '../components/User/AddUser.vue';
import AllUser from '../components/User/AllUser.vue';
import Profile from '../components/User/Profile.vue';

Vue.use(Router);

const routes = [
    {
        name:'vue-posts',
        path: '/posts',
        component: AllPost,
    },
    {
        name:'vue-posts-create',
        path: '/post-create',
        component: AddPost,
    },
    {
        name:'vue-users',
        path: '/users',
        component: AllUser,
    },
    {
        name:'vue-users-create',
        path: '/users-create',
        component: AddUser,
    },
    {
        name:'vue-user-profile',
        path: '/profile',
        component: Profile,
    },
  ];

export default new Router({
    mode:'history',
    routes:routes
});