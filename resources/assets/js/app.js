
import './bootstrap.js';
import './plugins/light-bootstrap-dashboard.js';

import Echo from 'laravel-echo';
import Vue from 'vue';
// import VueRouter from 'vue-router';

import App from './components/app/App';

// Html components
Vue.component('html-sidebar', require('./components/html/Sidebar.vue'))
Vue.component('html-navbar', require('./components/html/Navbar.vue'))
Vue.component('html-pagefooter', require('./components/html/PageFooter.vue'))

new Vue({

    el: '#app',

    components: {
        App
    },

    created() {
        let options = {};

        this.echo = new Echo(options);
    },

});
