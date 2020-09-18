import Vue from 'vue';
import Router from 'vue-router';
import AddPost from '../components/Post/AddPost.vue';
import ConfirmPost from '../components/Post/AddPostConfirm.vue';
import AllPost from '../components/Post/AllPost.vue';
import AddUser from '../components/User/AddUser.vue';
import AddUserConfirm from '../components/User/AddUserConfirm.vue';
import AllUser from '../components/User/AllUser.vue';
import Profile from '../components/User/Profile.vue';
import Login from '../components/Login/Login.vue';
import UploadCSV from '../components/CSV/UploadCSV.vue';

Vue.use(Router);

const routes = [
    {
        name:'posts',
        path: '/posts',
        component: AllPost,
    },
    {
        name:'posts-create',
        path: '/post-create',
        component: AddPost,
    },
    {
        name:'posts-create-confirm',
        path: '/posts-create/confirm',
        component: ConfirmPost,
    },
    {
        name:'upload',
        path: '/upload',
        component: UploadCSV,
    },
    {
        name:'users',
        path: '/all-user',
        component: AllUser,
    },
    {
        name:'users-create',
        path: '/users-create',
        component: AddUser,
    },
    {
        name:'users-create-confirm',
        path: '/users-create-confirm',
        component: AddUserConfirm,
    },
    {
        name:'profile',
        path: '/vue-profile',
        component: Profile,
    },
    {
        name:'login',
        path: '/vue-login',
        component: Login,
    },
  ];

export default new Router({
    mode:'history',
    routes:routes
});