'use strict'

const { mix } = require('laravel-mix');

var path = require('path')
var webpack = require('webpack')

 mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .version()

    .webpackConfig({

        resolve: {
            extensions: ['.js'],
        },

        entry: [
            'vue',
            'vuex',
            'vue-router',
            'vue-full-calendar',
            'vue-bootstrap-datetimepicker',
            'axios',
            'querystring',
            'sweetalert',
            'select2',
            './resources/assets/js/init/vue-services.js',
            './resources/assets/js/plugins/light-bootstrap-dashboard.js',
            './resources/assets/js/plugins/moment.js',
            // './resources/assets/js/init/vue-directives.js',
            './resources/assets/js/init/vue-filters.js',
            './resources/assets/js/init/vue-components.js',
            './resources/assets/js/init/vue-router.js',
            './resources/assets/sass/app.scss',
            'font-awesome/scss/font-awesome.scss',
        ],

        module: {
            rules: [
                {
                    test: /\.js?$/,
                    include: [
                        path.resolve(__dirname, 'resources/assets/js'),
                        'node_modules'
                    ],
                }
            ],
        },

        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                'jQuery': 'jquery',
                'window.jQuery': 'jquery',
                axios: 'axios',
                querystring: 'querystring',
                moment: 'moment',
                Vue: 'vue',
                Vuex: 'vuex',
                VueRouter: 'vue-router',
                FullCalendar: 'vue-full-calendar',
                swal: 'sweetalert',
                datePicker: 'vue-bootstrap-datetimepicker',
                RestCore: path.resolve(__dirname, 'resources/assets/js/services', 'core'),
                RestList: path.resolve(__dirname, 'resources/assets/js/services', 'list'),
                RestShow: path.resolve(__dirname, 'resources/assets/js/services', 'show'),
            }),
        ],

    });
