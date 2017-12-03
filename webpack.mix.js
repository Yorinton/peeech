const { mix } = require('laravel-mix');

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
// 
// sass('resources/assets/sass/app.scss', 'public/css')

// var bs = require('browser-sync').create();

// bs.init({
//     proxy: "http://homestead.app/",
// });

mix.browserSync({
  	host: 'homestead.app',
  	proxy: {
  	    target: "http://homestead.app",
  	    ws: true
  	},
      browser: "google chrome",
      files: [
         './**/*.css',
         './**/*.js',
         './app/*.php',
         './app/**/**/*.php',
         './app/**/**/**/*.php',
         './config/**/*',
         './resources/views/**/*.blade.php',
         './resources/views/*.blade.php',
         // './resources/assets/sass/*.scss',
         // './resources/assets/js/components/*.vue',
         './routes/**/*'
      ],
      watchOptions: {
        usePolling: true,
        interval: 100
      },
      open: "external",
      reloadOnRestart: true
  });

mix.js(['resources/assets/js/app.js','resources/assets/js/prof.js'], 'public/js/app.js')
  // .js('resources/assets/js/prof.js', 'public/js')
  .js('resources/assets/js/index.js','public/js/index_2.js')
  // .js('public/js/index.js','public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .sass('resources/assets/sass/main.scss', 'public/css')
  .options({
      postCss: [
          require('autoprefixer')()
      ],
      processCssUrls: false
  });

if (mix.config.inProduction) {
    mix.version();
}

