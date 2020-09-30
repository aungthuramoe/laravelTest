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
import store from '../store/index';

Vue.use(Router);
const routes = [
    {
        name: 'posts',
        path: '/posts',
        component: AllPost,
        meta: {
            guest: true
        }
    },
    {
        name: 'post-create',
        path: '/post-create',
        component: AddPost,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'posts-create-confirm',
        path: '/posts-create/confirm',
        component: ConfirmPost,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'upload',
        path: '/upload',
        component: UploadCSV,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'users',
        path: '/all-user',
        component: AllUser,
        meta: {
            requiresAuth: true,
            is_admin : true
        }
    },
    {
        name: 'users-create',
        path: '/users-create',
        component: AddUser,
        meta: {
            requiresAuth: true,
            is_admin : true
        }
    },
    {
        name: 'users-create-confirm',
        path: '/users-create-confirm',
        component: AddUserConfirm,
        meta: {
            requiresAuth: true,
            is_admin : true
        }
    },
    {
        name: 'users-update-confirm',
        path: '/users-update-confirm',
        component: UpdateUserConfirm,
        meta: {
            requiresAuth: true,
            is_admin : true
        }
    },
    {
        name: 'profile',
        path: '/vue-profile',
        component: Profile,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'edit-profile',
        path: '/vue-edit-profile',
        component: EditProfile,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'login',
        path: '/vue-login',
        component: Login,
        meta: {
            guest: true
        }
    },
    {
        name: 'change-password',
        path: '/vue-change-password',
        component: ChangePassword,
        meta: {
            requiresAuth: true
        }
    },
];
const router = new Router({
    mode: 'history',
    routes: routes
});
router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (store.state.UsersModule.isLogin == false) {
            next({
               name: 'login'
            })
        } 
        else {
            let user = store.state.UsersModule.currentUser
            if(to.matched.some(record => record.meta.is_admin && user.type == 0)) {
                next()
            }else {
                console.log(user.type)
                next({ name: 'posts'})
            }
        }
    } else if(to.matched.some(record => record.meta.guest)) {
        next()
    }
})
export default router