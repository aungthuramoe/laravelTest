/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import router from './router/routes';
import VueAxios from 'vue-axios';
import axios from 'axios';
import Vuelidate from 'vuelidate';
import Vuex from 'vuex'
import store from './store/index';
import excel from 'vue-excel-export'
 
// import Vuetify from 'vuetify'
//import 'vuetify/dist/vuetify.min.css'
// import Form from './Form';

require('./bootstrap');

window.Vue = require('vue');
// window.Form = Form;
// Vue.use(Vuetify);

Vue.use(VueAxios, axios);
Vue.use(Vuex);
Vue.use(excel)
Vue.use(Vuelidate);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// const router = new VueRouter({ mode: 'history', routes: routes});
// const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');

Vue.component('app-component',require('./components/App.vue').default);
Vue.component('side-bar',require('./components/SideBar.vue').default);
Vue.component('add-post',require('./components/Post/AddPost.vue').default);
Vue.component('add-post-confirm',require('./components/Post/AddPostConfirm.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('add-user', require('./components/User/AddUser.vue').default);
Vue.component('all-user', require('./components/User/AllUser.vue').default);
Vue.component('upload-csv', require('./components/CSV/UploadCSV.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    router:router
});
