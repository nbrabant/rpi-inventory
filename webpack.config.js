
var path = require('path');
var CleanWebpackPlugin = require('clean-webpack-plugin');
var OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
var WebpackNotifierPlugin = require('webpack-notifier');
var ExtractTextPlugin = require('extract-text-webpack-plugin');
var ManifestPlugin = require('webpack-manifest-plugin');
var webpack = require('webpack');

let plugins = [
	new WebpackNotifierPlugin(),
	new CleanWebpackPlugin([
		'public/js',
        'public/styles',
        'public/images/hashed',
		'public/fonts/hashed'
	]),
    new webpack.ProvidePlugin({
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
    // new webpack.optimize.CommonsChunkPlugin({
    //     name: 'vendor'
    // }),
    new ManifestPlugin({
        fileName: 'rev-manifest.json'
	})
];

module.exports = {
	resolve: {
		modules: [
			"node_modules"
		],
		extensions: [".js", ".json", ".ts", ".css"],
	},

	entry: [
		'./resources/assets/scripts/core/vendor.ts',
		'./resources/assets/scripts/main.ts',
		'./resources/assets/less/app.less'
	],

	module: {
        rules: [
			{
			    test: /\.ts$/,
		        loaders: [
		          	{
			            loader: 'awesome-typescript-loader',
			            options: { configFileName: path.resolve(__dirname, 'resources/assets/scripts/config', 'tsconfig.json') }
		          	} , 'angular2-template-loader'
		        ]
		  	},
			{
		        test: /\.html$/,
		        loader: 'html-loader'
		    },
		    {
		        test: /\.(png|jpe?g|gif|svg|woff|woff2|ttf|eot|ico)$/,
		        loader: 'file-loader?name=assets/[name].[hash].[ext]'
		    },
			{
			    test: /\.css$/,
				// exclude: path.resolve(__dirname, 'app'),
			    loader: ExtractTextPlugin.extract({ fallbackLoader: 'style-loader', loader: 'css-loader?sourceMap' })
			},
	      	{
		        test: /\.css$/,
		        // include: path.resolve(__dirname, 'app'),
		        loader: 'raw-loader'
	      	}
		],
    },

	plugins: plugins,

	output: {
		path: path.resolve(__dirname, 'public/build'),
		filename: 'private.bundle.js',
	},
};
