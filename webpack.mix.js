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

mix.scripts('resources/js/ui.js', 'public/js/ui.js')
    .scripts('resources/js/entity/create.js', 'public/js/entity.create.js')
    .scripts('resources/js/post/posts.js', 'public/js/post.posts.js')
    .scripts('resources/js/loadResources.js', 'public/js/loadResources.js')
    .scripts('resources/js/profile/create.js', 'public/js/profile.create.js')
    .scripts('resources/js/entity/upload.photos.js', 'public/js/entity.upload.photos.js')
    .scripts('resources/js/app.js', 'public/js/app.js')
    .less('resources/less/app.less', 'public/css/app.css');
