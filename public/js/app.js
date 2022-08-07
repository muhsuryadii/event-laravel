(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/app"],{

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");
/* import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start(); */


function dataTableController(id) {
  return {
    id: id,
    deleteItem: function deleteItem() {
      var _this = this;

      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(function (result) {
        if (result.isConfirmed) {
          Livewire.emit("deleteItem", _this.id);
        }
      });
    }
  };
}

function dataTableMainController() {
  return {
    setCallback: function setCallback() {
      Livewire.on("deleteResult", function (result) {
        if (result.status) {
          Swal.fire("Deleted!", result.message, "success");
        } else {
          Swal.fire("Error!", result.message, "error");
        }
      });
    }
  };
}

window.__controller = {
  dataTableController: dataTableController,
  dataTableMainController: dataTableMainController
};

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

window._ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo';
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

/***/ }),

/***/ "./resources/css/print.scss":
/*!**********************************!*\
  !*** ./resources/css/print.scss ***!
  \**********************************/
/***/ (() => {

throw new Error("Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):\nModuleBuildError: Module build failed (from ./node_modules/postcss-loader/dist/cjs.js):\nError: Cannot find module '@tailwindcss-plugins/pagination'\nRequire stack:\n- C:\\laragon\\www\\event-laravel\\tailwind.config.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\tailwindcss\\lib\\lib\\setupTrackingContext.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\tailwindcss\\lib\\index.js\n- C:\\laragon\\www\\event-laravel\\webpack.mix.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\laravel-mix\\setup\\webpack.config.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\webpack-cli\\lib\\webpack-cli.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\webpack-cli\\lib\\bootstrap.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\webpack-cli\\bin\\cli.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\webpack\\bin\\webpack.js\n    at Function.Module._resolveFilename (node:internal/modules/cjs/loader:933:15)\n    at Function.Module._load (node:internal/modules/cjs/loader:778:27)\n    at Module.require (node:internal/modules/cjs/loader:1005:19)\n    at require (node:internal/modules/cjs/helpers:102:18)\n    at Object.<anonymous> (C:\\laragon\\www\\event-laravel\\tailwind.config.js:37:9)\n    at Module._compile (node:internal/modules/cjs/loader:1101:14)\n    at Object.Module._extensions..js (node:internal/modules/cjs/loader:1153:10)\n    at Module.load (node:internal/modules/cjs/loader:981:32)\n    at Function.Module._load (node:internal/modules/cjs/loader:822:12)\n    at Module.require (node:internal/modules/cjs/loader:1005:19)\n    at processResult (C:\\laragon\\www\\event-laravel\\node_modules\\webpack\\lib\\NormalModule.js:758:19)\n    at C:\\laragon\\www\\event-laravel\\node_modules\\webpack\\lib\\NormalModule.js:860:5\n    at C:\\laragon\\www\\event-laravel\\node_modules\\loader-runner\\lib\\LoaderRunner.js:400:11\n    at C:\\laragon\\www\\event-laravel\\node_modules\\loader-runner\\lib\\LoaderRunner.js:252:18\n    at context.callback (C:\\laragon\\www\\event-laravel\\node_modules\\loader-runner\\lib\\LoaderRunner.js:124:13)\n    at Object.loader (C:\\laragon\\www\\event-laravel\\node_modules\\postcss-loader\\dist\\index.js:142:7)");

/***/ }),

/***/ "./resources/css/style.scss":
/*!**********************************!*\
  !*** ./resources/css/style.scss ***!
  \**********************************/
/***/ (() => {

throw new Error("Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):\nModuleBuildError: Module build failed (from ./node_modules/postcss-loader/dist/cjs.js):\nError: Cannot find module '@tailwindcss-plugins/pagination'\nRequire stack:\n- C:\\laragon\\www\\event-laravel\\tailwind.config.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\tailwindcss\\lib\\lib\\setupTrackingContext.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\tailwindcss\\lib\\index.js\n- C:\\laragon\\www\\event-laravel\\webpack.mix.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\laravel-mix\\setup\\webpack.config.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\webpack-cli\\lib\\webpack-cli.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\webpack-cli\\lib\\bootstrap.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\webpack-cli\\bin\\cli.js\n- C:\\laragon\\www\\event-laravel\\node_modules\\webpack\\bin\\webpack.js\n    at Function.Module._resolveFilename (node:internal/modules/cjs/loader:933:15)\n    at Function.Module._load (node:internal/modules/cjs/loader:778:27)\n    at Module.require (node:internal/modules/cjs/loader:1005:19)\n    at require (node:internal/modules/cjs/helpers:102:18)\n    at Object.<anonymous> (C:\\laragon\\www\\event-laravel\\tailwind.config.js:37:9)\n    at Module._compile (node:internal/modules/cjs/loader:1101:14)\n    at Object.Module._extensions..js (node:internal/modules/cjs/loader:1153:10)\n    at Module.load (node:internal/modules/cjs/loader:981:32)\n    at Function.Module._load (node:internal/modules/cjs/loader:822:12)\n    at Module.require (node:internal/modules/cjs/loader:1005:19)\n    at processResult (C:\\laragon\\www\\event-laravel\\node_modules\\webpack\\lib\\NormalModule.js:758:19)\n    at C:\\laragon\\www\\event-laravel\\node_modules\\webpack\\lib\\NormalModule.js:860:5\n    at C:\\laragon\\www\\event-laravel\\node_modules\\loader-runner\\lib\\LoaderRunner.js:400:11\n    at C:\\laragon\\www\\event-laravel\\node_modules\\loader-runner\\lib\\LoaderRunner.js:252:18\n    at context.callback (C:\\laragon\\www\\event-laravel\\node_modules\\loader-runner\\lib\\LoaderRunner.js:124:13)\n    at Object.loader (C:\\laragon\\www\\event-laravel\\node_modules\\postcss-loader\\dist\\index.js:142:7)");

/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ (() => {

throw new Error("Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):\nModuleBuildError: Module build failed (from ./node_modules/postcss-loader/dist/cjs.js):\nSyntaxError\n\n(2:1) C:\\laragon\\www\\event-laravel\\resources\\css\\app.css The `list-reset` class does not exist. If `list-reset` is a custom class, make sure it is defined within a `@layer` directive.\n\n \u001b[90m 1 | \u001b[39m\u001b[36m@import\u001b[39m \u001b[32m'tailwindcss/base'\u001b[39m\u001b[33m;\u001b[39m\n\u001b[1m\u001b[31m>\u001b[39m\u001b[22m\u001b[90m 2 | \u001b[39m\u001b[36m@import\u001b[39m \u001b[32m'tailwindcss/components'\u001b[39m\u001b[33m;\u001b[39m\n \u001b[90m   | \u001b[39m\u001b[1m\u001b[31m^\u001b[39m\u001b[22m\n \u001b[90m 3 | \u001b[39m\u001b[36m@import\u001b[39m \u001b[32m'tailwindcss/utilities'\u001b[39m\u001b[33m;\u001b[39m\n \u001b[90m 4 | \u001b[39m\n\n    at processResult (C:\\laragon\\www\\event-laravel\\node_modules\\webpack\\lib\\NormalModule.js:758:19)\n    at C:\\laragon\\www\\event-laravel\\node_modules\\webpack\\lib\\NormalModule.js:860:5\n    at C:\\laragon\\www\\event-laravel\\node_modules\\loader-runner\\lib\\LoaderRunner.js:400:11\n    at C:\\laragon\\www\\event-laravel\\node_modules\\loader-runner\\lib\\LoaderRunner.js:252:18\n    at context.callback (C:\\laragon\\www\\event-laravel\\node_modules\\loader-runner\\lib\\LoaderRunner.js:124:13)\n    at Object.loader (C:\\laragon\\www\\event-laravel\\node_modules\\postcss-loader\\dist\\index.js:140:7)");

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["/js/vendor"], () => (__webpack_exec__("./resources/js/app.js"), __webpack_exec__("./resources/css/print.scss"), __webpack_exec__("./resources/css/style.scss"), __webpack_exec__("./resources/css/app.css")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);