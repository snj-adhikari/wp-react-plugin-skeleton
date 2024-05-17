const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
	...defaultConfig,
	entry: {
		'option-page': [
			'./src/option-page/index.tsx',
			'./src/style/option-page.scss',
		],
		frontend: ['./src/frontend/index.ts', './src/style/frontend.scss'],
		blocks: ['./src/blocks/index.ts', './src/style/blocks.scss'],
	},
	output: {
		filename: '[name].js',
		path: path.resolve(__dirname, 'dist'),
	},
	resolve: {
		extensions: ['.ts', '.tsx', '.js'],
	},
	module: {
		rules: [
			{
				test: /\.(ts|tsx)$/, // modified to include both .ts and .tsx files
				exclude: (file) => /node_modules/.test(file) || /\.test\.tsx?$/.test(file),
				use: 'ts-loader',
			},
			{
				test: /\.scss$/,
				use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'],
			},
		],
	},
	plugins: [
		...defaultConfig.plugins,
		new MiniCssExtractPlugin({
			filename: '[name].css',
		}),
	],
};
