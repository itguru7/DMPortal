import Home             from './pages/Home.vue';
import Application      from './pages/Application.vue';

export const routes = [
    { path: '/', component: Home },
    { path: '/:vendor', component: Application }
];
