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

mix.webpackConfig({
   resolve: {
      alias: {
          'vuejs-datatable': 'vuejs-datatable/dist/vuejs-datatable.esm.js',
      }
  },
})
.js('resources/js/app.js', 'public/frontend/js')
   .sass('resources/sass/app.scss', 'public/frontend/css');
