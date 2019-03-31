
require('./bootstrap');

import { SERVER_URL } from './url';
window.SERVER_URL = SERVER_URL;

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import DatatableFactory from 'vuejs-datatable';

Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.use(DatatableFactory);

import { routes } from './routes';
import { store } from './store/store';

import App from './App.vue';

const router = new VueRouter({
    routes,
    mode: 'history'
});

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
