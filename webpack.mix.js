const mix = require('laravel-mix');

mix.scripts('resources/js/ui.js', 'public/js/ui.js')
    .scripts('resources/js/imageUpload.js', 'public/js/imageUpload.js')
    .scripts('resources/js/entity/create.js', 'public/js/entity.create.js')
    .scripts('resources/js/post/posts.js', 'public/js/post.posts.js')
    .scripts('resources/js/loadResources.js', 'public/js/loadResources.js')
    .scripts('resources/js/profile/create.js', 'public/js/profile.create.js')
    .scripts('resources/js/entity/upload.photos.js', 'public/js/entity.upload.photos.js')
    .scripts('resources/js/app.js', 'public/js/app.js')
    .scripts('resources/js/adminDashboard.js', 'public/js/adminDashboard.js')
    .scripts('resources/js/home.js', 'public/js/home.js')
    .less('resources/less/app.less', 'public/css/app.css')
    .less('resources/less/messenger.less', 'public/css/messenger.css')
    .less('resources/less/home.less', 'public/css/home.css');
