'use strict'

const mix = require('laravel-mix');

var path = require('path')
var webpack = require('webpack')

 mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version()
    
    .webpackConfig({

        resolve: {
            extensions: ['.js'],
        },

        entry: [
            'vue',
            'vue-router',
            'vue-full-calendar',
            'vue-bootstrap-datetimepicker',
            'axios',
            'querystring',
            'sweetalert2',
            'select2',
            // './resources/js/plugins/light-bootstrap-dashboard.js',
            './resources/js/plugins/moment.js',
            './resources/js/plugins/weatherwidget.js',
            // './resources/js/init/vue-directives.js',
            './resources/js/init/vue-filters.js',
            './resources/js/init/vue-components.js',
            './resources/js/init/vue-router.js',
            './resources/sass/app.scss',
            'font-awesome/scss/font-awesome.scss',
            './resources/js/event-bus.js',
        ],

        module: {
            rules: [
                {
                    test: /\.js?$/,
                    include: [
                        path.resolve(__dirname, 'resources/js')
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
                VueRouter: 'vue-router',
                FullCalendar: 'vue-full-calendar',
                swal: 'sweetalert2',
                datePicker: 'vue-bootstrap-datetimepicker',
            }),
        ]

    });
