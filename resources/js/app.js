
import axios from 'axios';
import Swal from 'sweetalert2';
// import { createPopper } from '@popperjs/core';
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'
// import DataTable from 'datatables.net-dt';
// import $ from 'jquery';

import Vue from 'vue';
import Vue2Editor from "vue2-editor";


import RegistrationForm from './components/RegistrationForm.vue';
import LoginForm from './components/LoginComponent.vue';
import InsurancePurchaseComponent from "./components/InsurancePurchaseComponent.vue";
import WelcomeComponent from "./components/WelcomeComponent.vue";
import HeaderComponent from "./components/HeaderComponent.vue";
import AdminSidebarComponent from "./components/AdminSidebarComponent.vue";
import BlogComponent from './components/BlogComponent.vue';
import UsersComponent from './components/UsersComponent.vue';
import AdminWelcomeComponent from "./components/AdminWelcomeComponent.vue";
import AdminComponent from "./components/AdminComponent.vue";
import AllBlogsComponent from "./components/AllBlogsComponent.vue";
import CreatePostComponent from "./components/CreatePostComponent.vue";
import UpdateBlogComponent from "./components/UpdateBlogComponent.vue";
import InsuranceComponent from "./components/InsuranceComponent.vue";
import DependentsComponent from "./components/DependentsComponent.vue";

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {
    faBars,
    faChevronLeft,
    faChevronRight,
    faCog,
    faHandshake,
    faNewspaper,
    faUsers,
    faShieldAlt
} from '@fortawesome/free-solid-svg-icons';


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;
library.add(faBars, faChevronRight, faChevronLeft, faNewspaper, faUsers, faCog, faHandshake, faShieldAlt);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */



// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('registration-form', RegistrationForm);
Vue.component('login-form', LoginForm);
Vue.component('insurance-purchase', InsurancePurchaseComponent);
Vue.component('welcome-component', WelcomeComponent);
Vue.component('header-component', HeaderComponent);
Vue.component('admin-sidebar-component', AdminSidebarComponent);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('blog-component', BlogComponent);
Vue.component('users-component', UsersComponent);
Vue.component('admin-welcome-component', AdminWelcomeComponent);
Vue.component('admin-component', AdminComponent);
Vue.component('all-blogs-component', AllBlogsComponent);
Vue.component('create-post-component', CreatePostComponent);
Vue.component('update-blog-component', UpdateBlogComponent);
Vue.component('insurance-component', InsuranceComponent);
Vue.component('dependents-component', DependentsComponent);
Vue.use(Vue2Editor);

Vue.config.productionTip = false;


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
});


