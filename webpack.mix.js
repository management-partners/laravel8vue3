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

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

mix.js('resources/js/frontend/app.js', 'public/js')
    .sass('resources/sass/frontend/app.scss', 'public/css')
    .js('resources/js/backend/admin.js', 'public/backend/js')
    .sass('resources/sass/backend/admin.scss', 'public/backend/css');