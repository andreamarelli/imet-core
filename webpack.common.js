const path = require('path');
const { VueLoaderPlugin } = require('vue-loader')

module.exports = {

    entry: {
        index: './src/assets/index.js',
        vendor: './src/assets/vendor.js'
    },

    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: 'imet_core_[name].js'
    },

    resolve: {
        alias: {
            '~vendor': path.resolve(__dirname, '../', 'vendor/'),
        }
    },

    module: {
        rules: [
            {
                test: /\.[s]*css$/,
                use: [
                    'vue-style-loader',
                    'style-loader',
                    'css-loader',
                    'sass-loader'
                ],
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.(png|jpg|gif)$/i,
                use: [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 8192,
                            name: '[name].[ext]',
                            outputPath: 'images'
                        },
                    },
                ],
            }
        ],
    },

    plugins: [
        new VueLoaderPlugin()
    ]
}
