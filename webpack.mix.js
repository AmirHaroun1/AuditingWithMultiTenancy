const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
var CaseSensitivePathsPlugin = require('case-sensitive-paths-webpack-plugin');
var vuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');

var webpackConfig = {
    plugins: [
        new CaseSensitivePathsPlugin(),
        new vuetifyLoaderPlugin()
        // other plugins ...
    ]
    // other webpack config ...
}

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
