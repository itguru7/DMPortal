
require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

import { routes } from './routes';
import { store } from './store';

import App from './App.vue';

Vue.use(VueRouter)
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
