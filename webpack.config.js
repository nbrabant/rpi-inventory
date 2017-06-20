
var path = require('path');
var CleanWebpackPlugin = require('clean-webpack-plugin');
var OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
var WebpackNotifierPlugin = require('webpack-notifier');
var ExtractTextPlugin = require('extract-text-webpack-plugin');
var ManifestPlugin = require('webpack-manifest-plugin');
var webpack = require('webpack');

const isProduction = process.env.NODE_ENV === 'production';

let plugins = [
	new WebpackNotifierPlugin(),
	new CleanWebpackPlugin([
		'public/js',
        'public/styles',
        'public/images/hashed',
		'public/fonts/hashed'
	]),
    new webpack.ProvidePlugin({
		$: 'jquery',
        'jQuery': 'jquery',
        'window.jQuery': 'jquery',
		'__decorate': 'typescript-decorate',
        '__extends': 'typescript-extends',
        '__param': 'typescript-param',
        '__metadata': 'typescript-metadata'
	}),
	new webpack.ContextReplacementPlugin(
	  /angular(\\|\/)core(\\|\/)@angular/,
	  path.resolve(__dirname)
	),
	new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/),
    new ExtractTextPlugin('styles/app-[hash].css'),
	new webpack.optimize.CommonsChunkPlugin({
		names: ['main', 'vendor', 'polyfills']
	}),
    new ManifestPlugin({
        fileName: 'rev-manifest.json'
	})
];

module.exports = {
	entry: {
		polyfills: 	path.resolve(__dirname, 'resources/assets/scripts/core', 'polyfills.ts'),
		vendor: 	path.resolve(__dirname, 'resources/assets/scripts/core', 'vendor.ts'),
		main: 		path.resolve(__dirname, 'resources/assets/scripts', 'main.ts'),
		style: 		path.resolve(__dirname, 'resources/assets/scss', 'app.scss')
	},

	devtool: isProduction ? 'source-map' : false,

	stats: {
        children: false
	},

	resolve: {
		extensions: [".js", ".ts"],
	},

	module: {
        rules: [
			{
			    test: /\.ts$/,
		        loaders: [
		          	{
			            loader: 'awesome-typescript-loader',
			            options: {
							configFileName: path.resolve(__dirname, 'tsconfig.json')
						}
		          	} , 'angular2-template-loader'
		        ]
		 	}, {
				test: /\.html$/,
				loader: 'html-loader'
			}, {
				test: /\.scss$/,
				loaders: ['style-loader', 'css-loader', 'sass-loader']
			}, {
                test: /\.(gif|png|jpg|jpeg|svg)($|\?)/,
                loaders: 'url?limit=10000&name=images/hashed/[name].[hash].[ext]',
                exclude: /node_modules/
			}, {
				test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
    			use: "url-loader?limit=100000"
			}, {
				test: /bootstrap\/dist\/js\/umd\//,
				loader: 'imports?jQuery=jquery'
			}
		],
    },

	plugins: plugins,

	output: {
        path: path.resolve(__dirname, 'public/build'),
        filename: 'js/[name].[chunkhash].js',
        chunkFilename: 'js/chunks/[name].[chunkhash].js'
	}
};
