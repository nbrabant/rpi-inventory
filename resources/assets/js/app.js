
 import './bootstrap.js';

 import Echo from 'laravel-echo';
 import Vue from 'vue';

import Dashboard from './components/Dashboard';

new Vue({

    el: '#app',

    components: {
        Dashboard,
    },

    created() {
        let options = {};

        this.echo = new Echo(options);
    },

});
