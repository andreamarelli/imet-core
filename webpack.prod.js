const path = require('path');
const { merge } = require('webpack-merge');
const common = require('./webpack.common.js');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ManifestPlugin = require("webpack-assets-manifest");

module.exports = merge(common, {
    mode: 'production',

    output: {
        filename: '[name].[contenthash].js'
    },

    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].[contenthash].css',
        }),
        new ManifestPlugin({
            output: 'manifest.json',
        }),
    ]

});