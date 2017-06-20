webpackJsonp([2],{

/***/ 207:
/***/ (function(module, exports) {

throw new Error("Module build failed: \r\n  src: url('~font-awesome/fonts/fontawesome-webfont.eot?v=#{$fa-version}');\r\n                                                                        ^\r\n      Undefined variable: \"$fa-version\".\r\n      in F:\\web\\wamp\\www\\rpi-inventory\\resources\\assets\\scss\\app.scss (line 6, column 74)");

/***/ }),

/***/ 665:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(207);
if(typeof content === 'string') content = [[module.i, content, '']];
// add the styles to the DOM
var update = __webpack_require__(126)(content, {});
if(content.locals) module.exports = content.locals;
// Hot Module Replacement
if(false) {
	// When the styles change, update the <style> tags
	if(!content.locals) {
		module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/sass-loader/lib/loader.js!./app.scss", function() {
			var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/sass-loader/lib/loader.js!./app.scss");
			if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
			update(newContent);
		});
	}
	// When the module is disposed, remove the <style> tags
	module.hot.dispose(function() { update(); });
}

/***/ })

},[665]);