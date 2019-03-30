import Home             from './pages/Home.vue';
import Portal           from './pages/Portal.vue';

export const routes = [
    { path: '/', component: Home },
    { path: '/:vendor', component: Portal }
];
