const path = require('path');
const { VueLoaderPlugin } = require('vue-loader');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    mode: 'development',
    entry: './resources/js/app.js',
    output: {
        path: path.resolve(__dirname, 'public/js'),
        filename: 'app.js'
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'postcss-loader'
                ]
            }
        ]
    },
    plugins: [
        new VueLoaderPlugin(),
        new MiniCssExtractPlugin({
            filename: '../css/app.css'
        })
    ],
    resolve: {
        extensions: ['.tsx', '.ts', '.js', '.vue'],
        alias: {
            'vue': '@vue/runtime-dom'
        }
    }
};
