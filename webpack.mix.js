const mix = require('laravel-mix');

mix.config.fileLoaderDirs.fonts = 'fonts';

mix.webpackConfig({
    devtool: mix.config.production ? 'none' : 'source-map',
});

if (mix.config.production) {
    mix.version();
}

const config = [
    require('postcss-import'),
    require('tailwindcss')('./tailwind.config.js'),
    require('postcss-nested')({
        bubble: ['screen'],
    }),
];

mix.setPublicPath('public/assets/cms')
    .setResourceRoot('./')

    .js('resources/assets/js/app.js', 'public/assets/cms')
    .postCss('resources/assets/css/app.pcss', 'public/assets/cms', config)
    .postCss('resources/assets/css/content.pcss', 'public/assets/cms', config)
    .extract();
