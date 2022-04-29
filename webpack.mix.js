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

mix.less('resources/assets/css/style.less', 'public/css/style.css');

mix.styles([
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/select2/css/select2.min.css',
    'resources/assets/css/atlantis.min.css',
    'resources/assets/css/fonts.min.css',
], 'public/css/main.min.css');

mix.scripts([
    'resources/assets/js/plugin/webfont/webfont.min.js'
], 'public/js/webfont.min.js');

mix.scripts([
    'resources/assets/js/core/jquery.3.2.1.min.js',
    'resources/assets/js/core/popper.min.js',
    'resources/assets/js/core/bootstrap.min.js',
    'resources/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js',
    'resources/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js',
    'resources/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js',
    'resources/assets/select2/js/select2.min.js',
    'resources/assets/js/atlantis.min.js',
    'resources/assets/js/main.js',
], 'public/js/main.min.js');

mix.scripts([
    'resources/assets/js/plugin/sweetalert/sweetalert.min.js',
], 'public/js/sweetalert.min.js');

mix.styles([
    'resources/assets/login/fonts/material-icon/css/material-design-iconic-font.min.css',
    'resources/assets/login/css/style.css',
], 'public/css/login/style.min.css');

mix.scripts([
    'resources/assets/login/vendor/jquery/jquery.min.js',
    'resources/assets/login/js/main.js',
], 'public/js/login/scripts.min.js');


mix.copyDirectory('resources/assets/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/login/fonts', 'public/css/fonts');
mix.copyDirectory('resources/assets/img', 'public/img');
mix.copyDirectory('resources/assets/login/images', 'public/img/login');
