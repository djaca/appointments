import flatpicker from 'flatpickr'
import $ from 'jquery'
import 'fullcalendar'

require('flatpickr/dist/themes/material_blue.css')
require('fullcalendar/dist/fullcalendar.css')

require('./bootstrap');

window.Vue = require('vue');
window.$ = $

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});
