const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');


mix.webpackConfig({
    devtool: mix.config.production ? 'none' : 'source-map'
});

if (mix.config.production) {
    mix.version();
}

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

mix.setPublicPath('public/assets/cms')
    .setResourceRoot('./');

mix.js('resources/js/app.js', 'public/assets/cms')
    .sass('resources/sass/app.scss', 'public/assets/cms')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    })
    .extract();

