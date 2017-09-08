/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 75);
/******/ })
/************************************************************************/
/******/ ({

/***/ 1:
/***/ (function(module, exports) {

// this module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  scopeId,
  cssModules
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  // inject cssModules
  if (cssModules) {
    var computed = Object.create(options.computed || null)
    Object.keys(cssModules).forEach(function (key) {
      var module = cssModules[key]
      computed[key] = function () { return module }
    })
    options.computed = computed
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ 10:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)();
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

/***/ }),

/***/ 11:
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(6),
  /* template */
  __webpack_require__(14),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/vagrant/Code/Laravel/resources/assets/js/components/ProfIdol.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] ProfIdol.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0bc02b72", Component.options)
  } else {
    hotAPI.reload("data-v-0bc02b72", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 12:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(17)

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(7),
  /* template */
  __webpack_require__(15),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/vagrant/Code/Laravel/resources/assets/js/components/ProfIntroduction.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] ProfIntroduction.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2f5ac054", Component.options)
  } else {
    hotAPI.reload("data-v-2f5ac054", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 13:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(18)

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(8),
  /* template */
  __webpack_require__(16),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/home/vagrant/Code/Laravel/resources/assets/js/components/ProfName.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] ProfName.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-70a70445", Component.options)
  } else {
    hotAPI.reload("data-v-70a70445", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 14:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', [_vm._m(0), _vm._v(" "), _c('div', {
    staticClass: "disfle"
  }, [_c('select', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.selected),
      expression: "selected"
    }],
    staticClass: "form-control phonetic inputBaseStyle mr5 wd35",
    attrs: {
      "name": "phonetic"
    },
    on: {
      "change": [function($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function(o) {
          return o.selected
        }).map(function(o) {
          var val = "_value" in o ? o._value : o.value;
          return val
        });
        _vm.selected = $event.target.multiple ? $$selectedVal : $$selectedVal[0]
      }, _vm.selectPhonetic]
    }
  }, _vm._l((_vm.phonetics), function(phonetic) {
    return _c('option', {
      domProps: {
        "value": phonetic.value
      }
    }, [_vm._v(_vm._s(phonetic.text))])
  })), _vm._v(" "), _c('div', {
    staticClass: "wd65 mr5"
  }, [_c('select', {
    staticClass: "form-control form-idol disblo inputBaseStyle mr5",
    attrs: {
      "name": "idol",
      "id": "idols_1"
    }
  }, _vm._l((_vm.idol_masters), function(idol) {
    return (idol.phonetic_id >= 1 && idol.phonetic_id <= 5) ? _c('option', [_vm._v(_vm._s(idol.idol))]) : _vm._e()
  })), _vm._v(" "), _c('select', {
    staticClass: "form-control form-idol disnone inputBaseStyle mr5",
    attrs: {
      "name": "",
      "id": "idols_2"
    }
  }, _vm._l((_vm.idol_masters), function(idol) {
    return (idol.phonetic_id >= 6 && idol.phonetic_id <= 10) ? _c('option', [_vm._v(_vm._s(idol.idol))]) : _vm._e()
  })), _vm._v(" "), _c('select', {
    staticClass: "form-control form-idol disnone inputBaseStyle mr5",
    attrs: {
      "name": "",
      "id": "idols_3"
    }
  }, _vm._l((_vm.idol_masters), function(idol) {
    return (idol.phonetic_id >= 11 && idol.phonetic_id <= 15) ? _c('option', [_vm._v(_vm._s(idol.idol))]) : _vm._e()
  })), _vm._v(" "), _c('select', {
    staticClass: "form-control form-idol disnone inputBaseStyle mr5",
    attrs: {
      "name": "",
      "id": "idols_4"
    }
  }, _vm._l((_vm.idol_masters), function(idol) {
    return (idol.phonetic_id >= 16 && idol.phonetic_id <= 20) ? _c('option', [_vm._v(_vm._s(idol.idol))]) : _vm._e()
  })), _vm._v(" "), _c('select', {
    staticClass: "form-control form-idol disnone inputBaseStyle mr5",
    attrs: {
      "name": "",
      "id": "idols_5"
    }
  }, _vm._l((_vm.idol_masters), function(idol) {
    return (idol.phonetic_id >= 21 && idol.phonetic_id <= 25) ? _c('option', [_vm._v(_vm._s(idol.idol))]) : _vm._e()
  })), _vm._v(" "), _c('select', {
    staticClass: "form-control form-idol disnone inputBaseStyle mr5",
    attrs: {
      "name": "",
      "id": "idols_6"
    }
  }, _vm._l((_vm.idol_masters), function(idol) {
    return (idol.phonetic_id >= 26 && idol.phonetic_id <= 30) ? _c('option', [_vm._v(_vm._s(idol.idol))]) : _vm._e()
  })), _vm._v(" "), _c('select', {
    staticClass: "form-control form-idol disnone inputBaseStyle mr5",
    attrs: {
      "name": "",
      "id": "idols_7"
    }
  }, _vm._l((_vm.idol_masters), function(idol) {
    return (idol.phonetic_id >= 31 && idol.phonetic_id <= 35) ? _c('option', [_vm._v(_vm._s(idol.idol))]) : _vm._e()
  })), _vm._v(" "), _c('select', {
    staticClass: "form-control form-idol disnone inputBaseStyle mr5",
    attrs: {
      "name": "",
      "id": "idols_8"
    }
  }, _vm._l((_vm.idol_masters), function(idol) {
    return (idol.phonetic_id >= 36 && idol.phonetic_id <= 40) ? _c('option', [_vm._v(_vm._s(idol.idol))]) : _vm._e()
  })), _vm._v(" "), _c('select', {
    staticClass: "form-control form-idol disnone inputBaseStyle mr5",
    attrs: {
      "name": "",
      "id": "idols_9"
    }
  }, _vm._l((_vm.idol_masters), function(idol) {
    return (idol.phonetic_id >= 41 && idol.phonetic_id <= 45) ? _c('option', [_vm._v(_vm._s(idol.idol))]) : _vm._e()
  })), _vm._v(" "), _c('select', {
    staticClass: "form-control form-idol disnone inputBaseStyle mr5",
    attrs: {
      "name": "",
      "id": "idols_10"
    }
  }, _vm._l((_vm.idol_masters), function(idol) {
    return (idol.phonetic_id === 46) ? _c('option', [_vm._v(_vm._s(idol.idol))]) : _vm._e()
  }))]), _vm._v(" "), _c('button', {
    staticClass: "btn btn-idol ml5 btn_add",
    on: {
      "click": _vm.addIdol
    }
  }, [_vm._v("+")])]), _vm._v(" "), _c('div', {
    staticClass: "wrap mt10 mb10"
  }, _vm._l((_vm.idol_names), function(idol) {
    return _c('span', {
      staticClass: "added_idol tag_pink mr5 mb5",
      on: {
        "click": function($event) {
          _vm.removeIdol(idol)
        }
      }
    }, [_vm._v("× " + _vm._s(idol.idol))])
  }))])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('label', {
    staticClass: "label_prof wd80"
  }, [_c('span', [_vm._v("好きなアイドル")])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-0bc02b72", module.exports)
  }
}

/***/ }),

/***/ 15:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('textarea', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.introduction),
      expression: "introduction"
    }],
    staticClass: "form-control inputBaseStyle mr10",
    attrs: {
      "name": "introduction",
      "placeholder": "自己紹介",
      "rows": "5",
      "required": ""
    },
    domProps: {
      "value": (_vm.introduction)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.introduction = $event.target.value
      }
    }
  }), _vm._v(" "), _c('button', {
    staticClass: "form-control wd30 fs10",
    on: {
      "click": _vm.sendIntroduction
    }
  }, [_vm._v("変更")])])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-2f5ac054", module.exports)
  }
}

/***/ }),

/***/ 16:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group disfle"
  }, [_c('input', {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: (_vm.name),
      expression: "name"
    }],
    staticClass: "form-control inputBaseStyle mr10",
    attrs: {
      "name": "name",
      "type": "text",
      "placeholder": "ニックネーム",
      "required": ""
    },
    domProps: {
      "value": (_vm.name)
    },
    on: {
      "input": function($event) {
        if ($event.target.composing) { return; }
        _vm.name = $event.target.value
      }
    }
  }), _vm._v(" "), _c('button', {
    staticClass: "form-control wd30 fs10",
    on: {
      "click": _vm.sendName
    }
  }, [_vm._v("変更")])])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-70a70445", module.exports)
  }
}

/***/ }),

/***/ 17:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(9);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("631ab30a", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-2f5ac054\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ProfIntroduction.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-2f5ac054\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ProfIntroduction.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 18:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(10);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("659e79e2", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-70a70445\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ProfName.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-70a70445\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ProfName.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 19:
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ }),

/***/ 2:
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function() {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		var result = [];
		for(var i = 0; i < this.length; i++) {
			var item = this[i];
			if(item[2]) {
				result.push("@media " + item[2] + "{" + item[1] + "}");
			} else {
				result.push(item[1]);
			}
		}
		return result.join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};


/***/ }),

/***/ 3:
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(19)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction) {
  isProduction = _isProduction

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[data-vue-ssr-id~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ }),

/***/ 4:
/***/ (function(module, exports, __webpack_require__) {

//プロフィール
Vue.component('prof-name', __webpack_require__(13));
Vue.component('prof-intro', __webpack_require__(12));
Vue.component('prof-idol', __webpack_require__(11));

//Vueインスタンス生成
var prof = new Vue({
	el: '#prof',
	methods: {
		editValue: function editValue(req) {
			axios.patch('/users/' + req.id, req.request).then(function (res) {
				console.log(res.data);
			});
		}
	}
});

/***/ }),

/***/ 6:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
	props: ["idols", "idol_masters", "user"],
	data: function data() {
		return {
			phonetics: [{ text: 'あ行', value: 1 }, { text: 'か行', value: 2 }, { text: 'さ行', value: 3 }, { text: 'た行', value: 4 }, { text: 'な行', value: 5 }, { text: 'は行', value: 6 }, { text: 'ま行', value: 7 }, { text: 'や行', value: 8 }, { text: 'ら行', value: 9 }, { text: 'わ行', value: 10 }],
			num: '',
			selected: '',
			request: {
				idol: ''
			},
			idol_names: this.idols,
			remId: ''
		};
	},
	methods: {
		addIdol: function addIdol() {
			var _this = this;

			this.request.idol = $("select[name='idol'] > option:selected").text();
			console.log(this.request.idol);
			axios.post('/users/' + this.user.id, this.request).then(function (res) {
				console.log(res.data);
				_this.idol_names.push(res.data.idol); //res.data = ['idol' => request('idol')]
			});
		},
		removeIdol: function removeIdol(idol) {
			this.remId = this.idol_names.indexOf(idol);
			this.idol_names.splice(this.remId, 1);
			axios.delete('/users/' + idol.id, { data: { idol: 'idol' } }).then(function (res) {
				console.log('成功');
			});
		},
		selectPhonetic: function selectPhonetic() {
			this.num = this.selected;
			$('.disblo').addClass('disnone').attr('name', '').removeClass('disblo');
			$("#idols_" + this.num).addClass('disblo').removeClass('disnone').attr('name', 'idol');
		}
	}
});

/***/ }),

/***/ 7:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
	props: ["user"], //profile.blade.phpからuserを受け取る
	data: function data() {
		return {
			introduction: this.user.introduction,
			request: {
				introduction: ''
			}
		};
	},
	methods: {
		sendIntroduction: function sendIntroduction() {
			if (this.introduction) {
				this.request.introduction = this.introduction;
				//namesentというイベントを送信
				this.$emit("introsent", {
					id: this.user.id,
					request: this.request
				});
			}
		}
	}
});

/***/ }),

/***/ 75:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(4);


/***/ }),

/***/ 8:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
	props: ["user"], //profile.blade.phpからuserを受け取る
	data: function data() {
		return {
			name: this.user.name,
			request: {
				name: ''
			}
		};
	},
	methods: {
		sendName: function sendName() {
			if (this.name) {
				this.request.name = this.name;
				//namesentというイベントを送信
				this.$emit("namesent", {
					id: this.user.id,
					request: this.request
				});
			}
		}
	}
});

/***/ }),

/***/ 9:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)();
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

/***/ })

/******/ });