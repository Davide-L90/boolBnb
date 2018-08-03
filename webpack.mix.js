let mix = require('laravel-mix');

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

mix.js([        
        'resources/assets/js/main.js',
        'resources/assets/js/userLogged/apartmentDetail.js',
        'resources/assets/js/publicViews/welcome.js'
    ], 'public/js/app.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .scripts([  
       'resources/assets/js/lib/jquery-3.3.1.js',
        'resources/assets/js/lib/geocomplete/jquery.geocomplete.js',
        'resources/assets/js/lib/moment.js',
        'resources/assets/js/lib/dropzone.js'
    ],'public/js/libraries.js');
