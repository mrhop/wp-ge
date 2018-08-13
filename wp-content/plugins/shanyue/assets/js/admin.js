/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./assets/js/admin.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/js/admin.js":
/*!****************************!*\
  !*** ./assets/js/admin.js ***!
  \****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(/*! ../scss/admin.scss */ "./assets/scss/admin.scss");

var admin = {
    sectionPageTypeChange: function sectionPageTypeChange() {
        document.getElementById('shanyue_page_sections[type]').addEventListener('change', function (event) {
            if (event.target.value === 'feature') {
                document.querySelector('.icon-class-tr').classList.remove('hidden');
            } else {
                document.querySelector('.icon-class-tr').classList.add('hidden');
            }
        });
    },
    mediaChoose: function mediaChoose() {
        var metaBox = document.querySelector('.shanyue-page-sections');
        if (metaBox) {
            var frame = void 0,
                addImgLink = metaBox.querySelector('.upload-custom-img'),
                delImgLink = metaBox.querySelector('.delete-custom-img'),
                imgContainer = metaBox.querySelector('.custom-img-container'),
                imgIdInput = metaBox.querySelector('.custom-img-id');

            addImgLink.addEventListener('click', function (event) {

                event.preventDefault();

                if (frame) {
                    frame.open();
                    return;
                }

                frame = wp.media({
                    title: 'Select or Upload Media',
                    button: {
                        text: 'Use this media'
                    },
                    multiple: false });

                frame.on('select', function () {
                    var attachment = frame.state().get('selection').first().toJSON();

                    imgContainer.innerHTML = '<img src="' + attachment.url + '" alt="" style="max-height:150px;"/>';

                    imgIdInput.value = attachment.id;

                    addImgLink.classList.add('hidden');

                    delImgLink.classList.remove('hidden');
                });

                frame.open();
            });

            delImgLink.addEventListener('click', function (event) {

                event.preventDefault();

                imgContainer.innerHTML = '';

                addImgLink.classList.remove('hidden');

                delImgLink.classList.add('hidden');

                imgIdInput.value = '';
            });
        }
    }
};

document.addEventListener('DOMContentLoaded', function () {
    admin.sectionPageTypeChange();
    admin.mediaChoose();
});

/***/ }),

/***/ "./assets/scss/admin.scss":
/*!********************************!*\
  !*** ./assets/scss/admin.scss ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ })

/******/ });
//# sourceMappingURL=admin.js.map