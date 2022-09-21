const mix = require('laravel-mix');

mix
    .js('resources/js/src/index.js','public/formy/js/laravel-formy.js')
    .vue()
