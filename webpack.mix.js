const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

const NODE_MODULES = 'node_modules/';

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .scripts([
        'public/js/app.js',
        NODE_MODULES + 'overlayscrollbars/js/jquery.overlayScrollbars.js'
    ], 'public/js/all.js')
    .styles([
        'public/css/app.css',
        NODE_MODULES + 'overlayscrollbars/css/OverlayScrollbars.css',
        'public/css/flag-icon.css'
    ], 'public/css/all.css')
    .js('resources/js/Models/User.js', 'public/js/user.js')
    .js('resources/js/Models/Role.js', 'public/js/role.js')
