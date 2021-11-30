const mix = require('laravel-mix');








mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/search-scripts-properties.js', 'public/js')
mix.js('resources/js/search-scripts-boats.js', 'public/js')
.sass('resources/sass/main.scss', 'public/css')
.sass('resources/sass/vendor.scss', 'public/css')
mix.extract(['vue', 'jquery']);


