import Home             from './pages/Home.vue';
import Application      from './pages/Application.vue';

import Filter           from './pages/Application/Filter.vue';
import Part             from './pages/Application/Part.vue';
import XRef             from './pages/Application/XRef.vue';

import PartImages       from './pages/Application/Part/PartImages.vue';
import PartInfo         from './pages/Application/Part/PartInfo.vue';
import PartBuyerGuide   from './pages/Application/Part/PartBuyerGuide.vue';
import PartInterchange  from './pages/Application/Part/PartInterchange.vue';


export const routes = [
    { path: '/', component: Home },
    { path: '/:name', component: Application, children: [
        { path: '', component: Filter },
        { path: '/part', component: Part, children: [
            { path: '/:id', component: PartImages },
            { path: '/:id/info', component: PartInfo },
            { path: '/:id/buyerguide', component: PartBuyerGuide },
            { path: '/:id/interchange', component: PartInterchange },
        ] },
        { path: '/xref', component: XRef }
    ] }
];
