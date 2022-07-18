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

throw new Error("Module build failed (from ./node_modules/mini-css-extract-plugin/dist/loader.js):\nModuleBuildError: Module build failed (from ./node_modules/postcss-loader/dist/cjs.js):\nSyntaxError\n\n(24:1) C:\\laragon\\www\\event-laravel\\resources\\css\\print.scss You cannot `@apply` the `table-responsive` utility here because it creates a circular dependency.\n\n \u001b[90m 22 | \u001b[39m\u001b[33m}\u001b[39m\n \u001b[90m 23 | \u001b[39m\n\u001b[1m\u001b[31m>\u001b[39m\u001b[22m\u001b[90m 24 | \u001b[39m\u001b[33m.table-responsive\u001b[39m \u001b[33m{\u001b[39m\n \u001b[90m    | \u001b[39m\u001b[1m\u001b[31m^\u001b[39m\u001b[22m\n \u001b[90m 25 | \u001b[39m  \u001b[36m@apply\u001b[39m table-responsive w-fit\u001b[33m;\u001b[39m\n \u001b[90m 26 | \u001b[39m\u001b[33m}\u001b[39m\n\n    at processResult (C:\\laragon\\www\\event-laravel\\node_modules\\webpack\\lib\\NormalModule.js:758:19)\n    at C:\\laragon\\www\\event-laravel\\node_modules\\webpack\\lib\\NormalModule.js:860:5\n    at C:\\laragon\\www\\event-laravel\\node_modules\\loader-runner\\lib\\LoaderRunner.js:400:11\n    at C:\\laragon\\www\\event-laravel\\node_modules\\loader-runner\\lib\\LoaderRunner.js:252:18\n    at context.callback (C:\\laragon\\www\\event-laravel\\node_modules\\loader-runner\\lib\\LoaderRunner.js:124:13)\n    at Object.loader (C:\\laragon\\www\\event-laravel\\node_modules\\postcss-loader\\dist\\index.js:140:7)");

/***/ }),

/***/ "./resources/css/style.scss":
/*!**********************************!*\
  !*** ./resources/css/style.scss ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["css/app","css/style","/js/vendor"], () => (__webpack_exec__("./resources/js/app.js"), __webpack_exec__("./resources/css/print.scss"), __webpack_exec__("./resources/css/style.scss"), __webpack_exec__("./resources/css/app.css")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);