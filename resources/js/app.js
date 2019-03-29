
require('./bootstrap');
window.Vue = require('vue');

import { SERVER_URL } from './url';
window.SERVER_URL = SERVER_URL;

import VueRouter from 'vue-router';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

import { routes } from './routes';
import { store } from './store/store';

import App from './App.vue';

Vue.use(VueRouter)
const router = new VueRouter({
    routes,
    mode: 'history'
});
Vue.use(Vuetify)

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
