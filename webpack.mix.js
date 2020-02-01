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

mix.scripts('resources/js/app.js', 'public/js/app.js')
    .scripts('resources/js/profile/create.js','public/js/profile.create.js')
    .less('resources/less/app.less', 'public/css/app.css');
