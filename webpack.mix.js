const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .styles([
       'resources/css/admin.css'
   ], 'public/css/admin.css')
   .scripts([
       'resources/js/admin.js'
   ], 'public/js/admin.js')
   .version(); 