const path = require('path');
const { merge } = require('webpack-merge');
const common = require('./webpack.common.js');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = merge(common, {
    mode: 'production',

    output: {
        filename: 'prod/imet_core_[name].js'
    },

    plugins: [
        new MiniCssExtractPlugin({
            filename: 'prod/imet_core_[name].css',
        }),
    ]

});
