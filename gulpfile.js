const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.styles([
        '../semantic.min.css'
    ], 'public/css/app.css').webpack('app.js');

    mix.scripts([
        '../js/arcana.js',
        '../js/clipboard.min.js',
        '../js/semantic.min.js',
        '../js/slip.js',
        '../js/datepicker.js'
    ]);

    mix.copy('resources/semantic/src/themes/default/assets/fonts/', 'public/fonts/');

    
});


