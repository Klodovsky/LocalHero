import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import ExampleComponent from "../components/ExampleComponent";
import BusinessType from "../components/BusinessType";

const routes = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: ExampleComponent,
            name: 'search'
        },
        {
            path: '/types',
            component: BusinessType,
            name: 'types'
        },
    ]
});

export default routes;
