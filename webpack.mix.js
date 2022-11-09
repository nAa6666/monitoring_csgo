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

mix.styles(['public/styles/style.css'],
    'public/styles/compiled/style.min.css'
).version();

mix.styles([
        'public/styles/framework/font-awesome.css',
        'public/styles/admin/style.css',
    ],
    'public/styles/compiled/admin/style.min.css'
).version();
