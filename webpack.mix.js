const mix = require("laravel-mix"),
    tailwindcss = require("tailwindcss");

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

mix.webpackConfig({
    optimization: {
        // this comes from the .extract() method we are commenting out
        runtimeChunk: {
            name: "/js/manifest",
        },
        splitChunks: {
            cacheGroups: {
                default: false, // disable default groups
                vendors: false, // disable vendors group
                // vendor chunk
                vendor: {
                    // name, chunk and test must be at the same level
                    name: "js/vendor",
                    chunks: "all",
                    minChunks: 2,
                    reuseExistingChunk: true,
                    enforce: true,
                    test(module /* , chunk */) {
                        if (module.context) {
                            // if this condition doesn't work try console.log on all module.context
                            return module.context.includes("node_modules/vue");
                        }
                        return false;
                    },
                },
                // common chunk
                commons: {
                    name: "commons",
                    minChunks: 2,
                    chunks: "all",
                    reuseExistingChunk: true,
                    enforce: true,
                    filename: "js/commons.js",
                },
            },
        },
    },
});

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        require("postcss-import"),
        require("tailwindcss"),
    ])
    .sass("resources/css/style.scss", "public/css")
    .extract()
    .browserSync({
        proxy: "http://event-laravel.test/",
        files: ["**/*.js", "**/*.css", "**/*.php"],
    });

// .browserSync({
//     proxy: "http://event-laravel.test/",
//     files: ["**/*.js", "**/*.css", "**/*.php"],
// });

if (mix.inProduction()) {
    mix.version();
}
