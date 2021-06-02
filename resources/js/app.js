
require('./bootstrap');
import Vue from 'vue';
import routes from './router/index';

import axios from 'axios'
import VueAxios from 'vue-axios'
import VueModal from '@kouts/vue-modal'
import '@kouts/vue-modal/dist/vue-modal.css'
Vue.use(VueAxios, axios)

Vue.component('app-header', require('./components/Header.vue').default);
Vue.component('Modal', VueModal);
// Vue.component('multiselect', Multiselect);
const app = new Vue({
    el: '#app',
    router: routes
});
