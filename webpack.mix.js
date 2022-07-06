const mix = require('laravel-mix');

mix.js('src/js/main.js', 'dist/js')
   .options({
      processCssUrls: false
   })
   .sass('src/scss/main.scss', 'dist/css', {
      implementation: require('node-sass')
   })
   .setPublicPath('./');

mix.autoload({
   jquery: ['$', 'window.jQuery']
});

mix.browserSync('localhost/github-jobs');