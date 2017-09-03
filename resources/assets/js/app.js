
import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';
// import VueRouter from 'vue-router';

import App from './components/app/App';


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
