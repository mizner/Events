"use strict";
const {resolve} = require('path');
const webpack = require('webpack');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const PROJECT = "ted-hughes-festivals";
const TEST_SITE = "http://ted-hughes.dev";
const APP_DIR = resolve(__dirname, 'src');
const BUILD_DIR = resolve(__dirname, 'dist');

module.exports = {
    entry: [APP_DIR + "/index.js"],
    output: {
        filename: PROJECT + ".min.js",
        path: BUILD_DIR,
        publicPath: "/"
    },

    context: APP_DIR,

    devtool: "inline-source-map",

    module: {
        rules: [
            {
                test: /\.js$/,
                use: [
                    "babel-loader",
                ],
                exclude: /node_modules/
            },
            {
                test: /\.css$/,
                use: [
                    "style-loader",
                    "css-loader?modules",
                ],
            },
        ],
    },

    plugins: [
        new BrowserSyncPlugin({
            // browse to http://localhost:3000/ during development,
            // ./public directory is being served
            host: "localhost",
            proxy: TEST_SITE,
            files: ['./**/*.php'],
            tunnel: true,
            // root: [__dirname],
            open: {file: "index.php"}
        })
    ],
};