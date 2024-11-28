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

//  라라벨 프로젝트와 뷰 프로젝트를 합쳐줌
mix.js('resources/js/app.js', 'public/js')
    .vue({
        version: 3,
    })
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
