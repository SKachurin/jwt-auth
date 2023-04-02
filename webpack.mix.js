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


mix.webpackConfig({ output: { filename: '[name].js', chunkFilename: 'js/[name].app.js', publicPath: '/' } });
//     output:{
//         chunkFilename: 'js/chunks/[name].js?id=[chunkhash]',
//     }
// });
// mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/app.js', 'public/js').version()
    .sass('resources/sass/get_rows.scss', 'public/css')
    .vue({
        options: {
            compilerOptions: {
                isCustomElement: (tag) => ['md-linedivider'].includes(tag),
            },
        },
    })
    .postCss('resources/css/app.css', 'public/css', [
        // require('postcss-import'),
        require('tailwindcss'),
        // require('autoprefixer'),
    ]);

// mix.js('resources/js/app.js', 'public/js').version()
//         .css('resources/css/app.css', 'public/css');
    // .sass('resources/sass/cms.scss', 'public/css')
    // .sass('resources/sass/main.scss', 'public/css')
    // .sass('resources/sass/error.scss', 'public/css');

mix.browserSync({proxy:'127.0.0.1:8000'});
