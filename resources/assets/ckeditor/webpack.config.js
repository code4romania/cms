/**
 * @license Copyright (c) 2014-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

'use strict';

/* eslint-env node */

const path = require('path');
const webpack = require('webpack');
const { bundler, styles } = require('@ckeditor/ckeditor5-dev-utils');
const CKEditorWebpackPlugin = require('@ckeditor/ckeditor5-dev-webpack-plugin');

module.exports = (env, config) => ({
    mode: 'production',
    devtool: process.env.NODE_ENV === 'production' ? 'none' : 'source-map',
    performance: { hints: false },

    entry: path.resolve(__dirname, 'src', 'ckeditor.js'),

    output: {
        // The name under which the editor will be exported.
        library: 'Editor',

        path: path.resolve(__dirname, '..', 'js', 'components'),
        filename: 'ckeditor.js',
        libraryTarget: 'umd',
        libraryExport: 'default',
    },

    plugins: [
        new CKEditorWebpackPlugin({
            // UI language. Language codes follow the https://en.wikipedia.org/wiki/ISO_639-1 format.
            // When changing the built-in language, remember to also change it in the editor's configuration (src/ckeditor.js).
            language: 'en',
        }),
        new webpack.BannerPlugin({
            banner: '/* eslint-disable */',
            raw: true,
        }),
    ],

    module: {
        rules: [
            {
                test: /\.svg$/,
                use: ['raw-loader'],
            },
            {
                test: /\.css$/,
                use: [
                    {
                        loader: 'style-loader',
                        options: {
                            injectType: 'singletonStyleTag',
                            attributes: {
                                'data-cke': true,
                            },
                        },
                    },
                    {
                        loader: 'postcss-loader',
                        options: styles.getPostCssConfig({
                            themeImporter: {
                                themePath: require.resolve(
                                    '@ckeditor/ckeditor5-theme-lark'
                                ),
                            },
                            minify: true,
                        }),
                    },
                ],
            },
        ],
    },
});
