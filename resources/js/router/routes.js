import Vue from 'vue';
import Router from 'vue-router';
import AddPost from '../components/Post/AddPost.vue';
import ConfirmPost from '../components/Post/AddPostConfirm.vue';
import AllPost from '../components/Post/AllPost.vue';
import AddUser from '../components/User/AddUser.vue';
import AddUserConfirm from '../components/User/AddUserConfirm.vue';
import UpdateUserConfirm from '../components/User/UpdateUserConfirm.vue';
import AllUser from '../components/User/AllUser.vue';
import Profile from '../components/User/Profile.vue';
import ChangePassword from '../components/User/ChangePassword.vue';
import EditProfile from '../components/User/EditProfile.vue';
import Login from '../components/Login/Login.vue';
import UploadCSV from '../components/CSV/UploadCSV.vue';

Vue.use(Router);
// function guardMyroute(to, from, next) {
//     if () {
//         next();
//     }
//     else {
//         next('/posts');
//     }
// }
const routes = [
    {
        name: 'posts',
        path: '/posts',
        component: AllPost,
    },
    {
        name: 'post-create',
        path: '/post-create',
        component: AddPost,
    },
    {
        name: 'posts-create-confirm',
        path: '/posts-create/confirm',
        component: ConfirmPost,
    },
    {
        name: 'upload',
        path: '/upload',
        component: UploadCSV,
    },
    {
        name: 'users',
        path: '/all-user',
        component: AllUser,
    },
    {
        name: 'users-create',
        path: '/users-create',
        component: AddUser,
    },
    {
        name: 'users-create-confirm',
        path: '/users-create-confirm',
        component: AddUserConfirm,
    },
    {
        name: 'users-update-confirm',
        path: '/users-update-confirm',
        component: UpdateUserConfirm,
    },
    {
        name: 'profile',
        path: '/vue-profile',
        component: Profile,
    },
    {
        name: 'edit-profile',
        path: '/vue-edit-profile',
        component: EditProfile,
    },
    {
        name: 'login',
        path: '/vue-login',
        component: Login,
    },
    {
        name: 'change-password',
        path: '/vue-change-password',
        component: ChangePassword,
    },
];
// routes.beforeEach((to, from, next) => {
//     if (isAuthenticated()) {
//         if (!hasPermissionsNeeded(to)) {
//             next('/posts');
//         } else {
//             next();
//         }
//     } else {
//         next('/vue-login');
//     }
// })
export default new Router({
    mode: 'history',
    routes: routes
});