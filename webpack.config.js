
var path = require('path')
var webpack = require('webpack')

module.exports = {
	resolve: {
		modules: [
			"node_modules"
		],
		extensions: [".js", ".json", ".jsx", ".css"],
	},
	entry: [
		'bootstrap-sass/assets/javascripts/bootstrap.min.js',
        'intl',
        'intl/locale-data/jsonp/fr.js',
        'moment',
        'select2',
        'sweetalert',
        'tinymce/tinymce.js',
        'tinymce/themes/modern/theme.js',
        'vue',
        'vue-resource',
        'vue-router',
		'./resources/assets/scripts/index.js'
	],
	output: {
		path: path.resolve(__dirname, 'public'),
		filename: 'private.bundle.js',
	},
	module: {
        rules: [],
    },
	plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            'jQuery': 'jquery',
            'window.jQuery': 'jquery',
            intl: 'intl',
            moment: 'moment',
        }),
    ],
};

// var config = require(path.join(__dirname, 'webpack-common'))

// for (var i = 0; i < config.length; ++i) {
//     withSourceMap = false
//
//     config[i].plugins.unshift(new webpack.DefinePlugin({
//         'process.env': {
//             'NODE_ENV': JSON.stringify('development'),
//         }
//     }))
//
//     for (var j = 0; j < config[i].module.loaders.length; ++j) {
//         if (config[i].module.loaders[j].hasOwnProperty('loader')) {
//             if (config[i].module.loaders[j].loader === 'css' || config[i].module.loaders[j].loader === 'sass') {
//                 config[i].module.loaders[j].loader += '?sourceMap'
//             }
//         } else if (config[i].module.loaders[j].hasOwnProperty('loaders')) {
//             for (var k = 0; k < config[i].module.loaders[j].loaders.length; ++k) {
//                 if (config[i].module.loaders[j].loaders[k] === 'css' || config[i].module.loaders[j].loaders[k] === 'sass') {
//                     config[i].module.loaders[j].loaders[k] += '?sourceMap'
//                 }
//             }
//         }
//     }
//
//     config[i].devtool = 'source-map'
//
// }

// module.exports = config
