const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        require("postcss-import"),
        require("tailwindcss"),
    ])
    .sass("resources/css/style.scss", "public/css")
    .browserSync({
        proxy: "http://event-laravel.test/",
        files: ["**/*.js", "**/*.css", "**/*.php"],
    });

if (mix.inProduction()) {
    mix.version();
}
