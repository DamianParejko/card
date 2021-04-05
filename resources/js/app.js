require('./bootstrap');

window.Vue = require('vue').default;

import axios from 'axios'

import { Datetime } from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
Vue.use(Datetime)
Vue.component('datetime', Datetime);

import ToggleButton from 'vue-js-toggle-button'
Vue.use(ToggleButton)

import { Settings } from 'luxon'
Settings.defaultLocale = 'en'

import './formatDate.js'

import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(FlashMessage);

Vue.component('pagination', require('laravel-vue-pagination'));

import VueRouter from 'vue-router'
Vue.use(VueRouter)
import { routes } from './routes.js'

const router = new VueRouter({
    routes:routes,
    mode: 'history'
})
 
const app = new Vue({
    router,
    el: '#app',
});
