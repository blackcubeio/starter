"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./css/main.css"
/*!**********************!*\
  !*** ./css/main.css ***!
  \**********************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ },

/***/ "./app/attributes/code-highlight.ts"
/*!******************************************!*\
  !*** ./app/attributes/code-highlight.ts ***!
  \******************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   CodeHighlight: () => (/* binding */ CodeHighlight)
/* harmony export */ });
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/kernel/dist/esm/index.dev.mjs");
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/runtime-html/dist/esm/index.dev.mjs");
/* harmony import */ var _services_transition_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../services/transition-service */ "./app/services/transition-service.ts");
/* harmony import */ var prismjs__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! prismjs */ "../../../../node_modules/prismjs/prism.js");
/* harmony import */ var prismjs__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(prismjs__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var prismjs_components_prism_bash__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! prismjs/components/prism-bash */ "../../../../node_modules/prismjs/components/prism-bash.js");
/* harmony import */ var prismjs_components_prism_bash__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(prismjs_components_prism_bash__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var prismjs_components_prism_css__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! prismjs/components/prism-css */ "../../../../node_modules/prismjs/components/prism-css.js");
/* harmony import */ var prismjs_components_prism_css__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(prismjs_components_prism_css__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var prismjs_components_prism_graphql__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! prismjs/components/prism-graphql */ "../../../../node_modules/prismjs/components/prism-graphql.js");
/* harmony import */ var prismjs_components_prism_graphql__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(prismjs_components_prism_graphql__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var prismjs_components_prism_javascript__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! prismjs/components/prism-javascript */ "../../../../node_modules/prismjs/components/prism-javascript.js");
/* harmony import */ var prismjs_components_prism_javascript__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(prismjs_components_prism_javascript__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var prismjs_components_prism_json__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! prismjs/components/prism-json */ "../../../../node_modules/prismjs/components/prism-json.js");
/* harmony import */ var prismjs_components_prism_json__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(prismjs_components_prism_json__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var prismjs_components_prism_markdown__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! prismjs/components/prism-markdown */ "../../../../node_modules/prismjs/components/prism-markdown.js");
/* harmony import */ var prismjs_components_prism_markdown__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(prismjs_components_prism_markdown__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var prismjs_components_prism_markup_templating__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! prismjs/components/prism-markup-templating */ "../../../../node_modules/prismjs/components/prism-markup-templating.js");
/* harmony import */ var prismjs_components_prism_markup_templating__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(prismjs_components_prism_markup_templating__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var prismjs_components_prism_php__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! prismjs/components/prism-php */ "../../../../node_modules/prismjs/components/prism-php.js");
/* harmony import */ var prismjs_components_prism_php__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(prismjs_components_prism_php__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var prismjs_components_prism_scss__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! prismjs/components/prism-scss */ "../../../../node_modules/prismjs/components/prism-scss.js");
/* harmony import */ var prismjs_components_prism_scss__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(prismjs_components_prism_scss__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var prismjs_components_prism_sql__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! prismjs/components/prism-sql */ "../../../../node_modules/prismjs/components/prism-sql.js");
/* harmony import */ var prismjs_components_prism_sql__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(prismjs_components_prism_sql__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var prismjs_components_prism_typescript__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! prismjs/components/prism-typescript */ "../../../../node_modules/prismjs/components/prism-typescript.js");
/* harmony import */ var prismjs_components_prism_typescript__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(prismjs_components_prism_typescript__WEBPACK_IMPORTED_MODULE_14__);
/* harmony import */ var prismjs_components_prism_yaml__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! prismjs/components/prism-yaml */ "../../../../node_modules/prismjs/components/prism-yaml.js");
/* harmony import */ var prismjs_components_prism_yaml__WEBPACK_IMPORTED_MODULE_15___default = /*#__PURE__*/__webpack_require__.n(prismjs_components_prism_yaml__WEBPACK_IMPORTED_MODULE_15__);
/**
 * code-highlight.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
var __esDecorate = (undefined && undefined.__esDecorate) || function (ctor, descriptorIn, decorators, contextIn, initializers, extraInitializers) {
    function accept(f) { if (f !== void 0 && typeof f !== "function") throw new TypeError("Function expected"); return f; }
    var kind = contextIn.kind, key = kind === "getter" ? "get" : kind === "setter" ? "set" : "value";
    var target = !descriptorIn && ctor ? contextIn["static"] ? ctor : ctor.prototype : null;
    var descriptor = descriptorIn || (target ? Object.getOwnPropertyDescriptor(target, contextIn.name) : {});
    var _, done = false;
    for (var i = decorators.length - 1; i >= 0; i--) {
        var context = {};
        for (var p in contextIn) context[p] = p === "access" ? {} : contextIn[p];
        for (var p in contextIn.access) context.access[p] = contextIn.access[p];
        context.addInitializer = function (f) { if (done) throw new TypeError("Cannot add initializers after decoration has completed"); extraInitializers.push(accept(f || null)); };
        var result = (0, decorators[i])(kind === "accessor" ? { get: descriptor.get, set: descriptor.set } : descriptor[key], context);
        if (kind === "accessor") {
            if (result === void 0) continue;
            if (result === null || typeof result !== "object") throw new TypeError("Object expected");
            if (_ = accept(result.get)) descriptor.get = _;
            if (_ = accept(result.set)) descriptor.set = _;
            if (_ = accept(result.init)) initializers.unshift(_);
        }
        else if (_ = accept(result)) {
            if (kind === "field") initializers.unshift(_);
            else descriptor[key] = _;
        }
    }
    if (target) Object.defineProperty(target, contextIn.name, descriptor);
    done = true;
};
var __runInitializers = (undefined && undefined.__runInitializers) || function (thisArg, initializers, value) {
    var useValue = arguments.length > 2;
    for (var i = 0; i < initializers.length; i++) {
        value = useValue ? initializers[i].call(thisArg, value) : initializers[i].call(thisArg);
    }
    return useValue ? value : void 0;
};















let CodeHighlight = (() => {
    let _classDecorators = [(0,aurelia__WEBPACK_IMPORTED_MODULE_1__.customAttribute)({ name: 'code-highlight', defaultProperty: 'language' })];
    let _classDescriptor;
    let _classExtraInitializers = [];
    let _classThis;
    let _language_decorators;
    let _language_initializers = [];
    let _language_extraInitializers = [];
    var CodeHighlight = class {
        static { _classThis = this; }
        static {
            const _metadata = typeof Symbol === "function" && Symbol.metadata ? Object.create(null) : void 0;
            _language_decorators = [(0,aurelia__WEBPACK_IMPORTED_MODULE_1__.bindable)()];
            __esDecorate(null, null, _language_decorators, { kind: "field", name: "language", static: false, private: false, access: { has: obj => "language" in obj, get: obj => obj.language, set: (obj, value) => { obj.language = value; } }, metadata: _metadata }, _language_initializers, _language_extraInitializers);
            __esDecorate(null, _classDescriptor = { value: _classThis }, _classDecorators, { kind: "class", name: _classThis.name, metadata: _metadata }, null, _classExtraInitializers);
            CodeHighlight = _classThis = _classDescriptor.value;
            if (_metadata) Object.defineProperty(_classThis, Symbol.metadata, { enumerable: true, configurable: true, writable: true, value: _metadata });
            __runInitializers(_classThis, _classExtraInitializers);
        }
        logger;
        p;
        element;
        transitionService;
        language = __runInitializers(this, _language_initializers, '');
        rawCode = (__runInitializers(this, _language_extraInitializers), '');
        copyButton = null;
        clickHandler = null;
        constructor(logger = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.ILogger).scopeTo('code-highlight'), p = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.IPlatform), element = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.INode), transitionService = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(_services_transition_service__WEBPACK_IMPORTED_MODULE_2__.ITransitionService)) {
            this.logger = logger;
            this.p = p;
            this.element = element;
            this.transitionService = transitionService;
            this.logger.trace('constructor');
        }
        attaching() {
            this.logger.trace('attaching');
            const codeElement = this.element.querySelector('code');
            const codeData = codeElement?.textContent ?? '';
            if (codeElement === null || codeData === '') {
                return;
            }
            this.rawCode = codeData.trim();
            if (this.language !== '' && (prismjs__WEBPACK_IMPORTED_MODULE_3___default().languages)[this.language] !== undefined) {
                this.logger.trace('Language found', this.language);
                const highlighted = prismjs__WEBPACK_IMPORTED_MODULE_3___default().highlight(this.rawCode, (prismjs__WEBPACK_IMPORTED_MODULE_3___default().languages)[this.language], this.language);
                codeElement.innerHTML = highlighted;
            }
        }
        attached() {
            this.logger.trace('attached');
            const group = this.element.closest('.group');
            if (group === null) {
                return;
            }
            this.copyButton = group.querySelector('[data-code-highlight="copy"]');
            if (this.copyButton === null) {
                return;
            }
            this.clickHandler = () => {
                this.p.window.navigator.clipboard.writeText(this.rawCode).then(() => {
                    this.logger.trace('Code copied');
                    const iconCopy = group.querySelector('[data-code-highlight="icon-copy"]');
                    const iconCopied = group.querySelector('[data-code-highlight="icon-copied"]');
                    if (iconCopy === null || iconCopied === null) {
                        return;
                    }
                    this.p.requestAnimationFrame(() => {
                        this.transitionService.run(iconCopied, (el) => el.classList.remove('scale-150'), (el) => {
                            el.classList.add('hidden');
                            iconCopy.classList.remove('hidden');
                        });
                    });
                    iconCopy.classList.add('hidden');
                    iconCopied.classList.add('scale-150');
                    iconCopied.classList.remove('hidden');
                });
            };
            this.copyButton.addEventListener('click', this.clickHandler);
        }
        detaching() {
            this.logger.trace('detaching');
            if (this.copyButton !== null && this.clickHandler !== null) {
                this.copyButton.removeEventListener('click', this.clickHandler);
                this.copyButton = null;
                this.clickHandler = null;
            }
        }
    };
    return CodeHighlight = _classThis;
})();



/***/ },

/***/ "./app/attributes/drawer-trigger.ts"
/*!******************************************!*\
  !*** ./app/attributes/drawer-trigger.ts ***!
  \******************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   BlackcubeDrawerTriggerCustomAttribute: () => (/* binding */ BlackcubeDrawerTriggerCustomAttribute)
/* harmony export */ });
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/kernel/dist/esm/index.dev.mjs");
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/runtime-html/dist/esm/index.dev.mjs");
/* harmony import */ var _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../enums/event-aggregator */ "./app/enums/event-aggregator.ts");
/**
 * drawer-trigger.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
var __esDecorate = (undefined && undefined.__esDecorate) || function (ctor, descriptorIn, decorators, contextIn, initializers, extraInitializers) {
    function accept(f) { if (f !== void 0 && typeof f !== "function") throw new TypeError("Function expected"); return f; }
    var kind = contextIn.kind, key = kind === "getter" ? "get" : kind === "setter" ? "set" : "value";
    var target = !descriptorIn && ctor ? contextIn["static"] ? ctor : ctor.prototype : null;
    var descriptor = descriptorIn || (target ? Object.getOwnPropertyDescriptor(target, contextIn.name) : {});
    var _, done = false;
    for (var i = decorators.length - 1; i >= 0; i--) {
        var context = {};
        for (var p in contextIn) context[p] = p === "access" ? {} : contextIn[p];
        for (var p in contextIn.access) context.access[p] = contextIn.access[p];
        context.addInitializer = function (f) { if (done) throw new TypeError("Cannot add initializers after decoration has completed"); extraInitializers.push(accept(f || null)); };
        var result = (0, decorators[i])(kind === "accessor" ? { get: descriptor.get, set: descriptor.set } : descriptor[key], context);
        if (kind === "accessor") {
            if (result === void 0) continue;
            if (result === null || typeof result !== "object") throw new TypeError("Object expected");
            if (_ = accept(result.get)) descriptor.get = _;
            if (_ = accept(result.set)) descriptor.set = _;
            if (_ = accept(result.init)) initializers.unshift(_);
        }
        else if (_ = accept(result)) {
            if (kind === "field") initializers.unshift(_);
            else descriptor[key] = _;
        }
    }
    if (target) Object.defineProperty(target, contextIn.name, descriptor);
    done = true;
};
var __runInitializers = (undefined && undefined.__runInitializers) || function (thisArg, initializers, value) {
    var useValue = arguments.length > 2;
    for (var i = 0; i < initializers.length; i++) {
        value = useValue ? initializers[i].call(thisArg, value) : initializers[i].call(thisArg);
    }
    return useValue ? value : void 0;
};


let BlackcubeDrawerTriggerCustomAttribute = (() => {
    let _classDecorators = [(0,aurelia__WEBPACK_IMPORTED_MODULE_1__.customAttribute)({ name: 'blackcube-drawer-trigger', defaultProperty: 'action' })];
    let _classDescriptor;
    let _classExtraInitializers = [];
    let _classThis;
    let _action_decorators;
    let _action_initializers = [];
    let _action_extraInitializers = [];
    var BlackcubeDrawerTriggerCustomAttribute = class {
        static { _classThis = this; }
        static {
            const _metadata = typeof Symbol === "function" && Symbol.metadata ? Object.create(null) : void 0;
            _action_decorators = [aurelia__WEBPACK_IMPORTED_MODULE_1__.bindable];
            __esDecorate(null, null, _action_decorators, { kind: "field", name: "action", static: false, private: false, access: { has: obj => "action" in obj, get: obj => obj.action, set: (obj, value) => { obj.action = value; } }, metadata: _metadata }, _action_initializers, _action_extraInitializers);
            __esDecorate(null, _classDescriptor = { value: _classThis }, _classDecorators, { kind: "class", name: _classThis.name, metadata: _metadata }, null, _classExtraInitializers);
            BlackcubeDrawerTriggerCustomAttribute = _classThis = _classDescriptor.value;
            if (_metadata) Object.defineProperty(_classThis, Symbol.metadata, { enumerable: true, configurable: true, writable: true, value: _metadata });
            __runInitializers(_classThis, _classExtraInitializers);
        }
        logger;
        element;
        ea;
        action = __runInitializers(this, _action_initializers, _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_2__.DrawerAction.Toggle);
        constructor(logger = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.ILogger).scopeTo('blackcube-drawer-trigger'), element = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.INode), ea = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.IEventAggregator)) {
            this.logger = logger;
            this.element = element;
            this.ea = ea;
            this.logger.trace('constructor');
        }
        attaching() {
            this.logger.trace('attaching');
            this.element.addEventListener('click', this.onClick);
        }
        detaching() {
            this.logger.trace('detaching');
            this.element.removeEventListener('click', this.onClick);
        }
        onClick = (__runInitializers(this, _action_extraInitializers), (event) => {
            event.preventDefault();
            const action = this.resolveAction(this.action);
            this.ea.publish(_enums_event_aggregator__WEBPACK_IMPORTED_MODULE_2__.Channels.Drawer, { action: action });
        });
        resolveAction(value) {
            switch (value) {
                case _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_2__.DrawerAction.Open:
                    return _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_2__.DrawerAction.Open;
                case _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_2__.DrawerAction.Close:
                    return _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_2__.DrawerAction.Close;
                default:
                    return _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_2__.DrawerAction.Toggle;
            }
        }
    };
    return BlackcubeDrawerTriggerCustomAttribute = _classThis;
})();



/***/ },

/***/ "./app/attributes/drawer.ts"
/*!**********************************!*\
  !*** ./app/attributes/drawer.ts ***!
  \**********************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   BlackcubeDrawerCustomAttribute: () => (/* binding */ BlackcubeDrawerCustomAttribute)
/* harmony export */ });
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/kernel/dist/esm/index.dev.mjs");
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/runtime-html/dist/esm/index.dev.mjs");
/* harmony import */ var _services_transition_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../services/transition-service */ "./app/services/transition-service.ts");
/* harmony import */ var _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../enums/event-aggregator */ "./app/enums/event-aggregator.ts");
/**
 * drawer.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
var __esDecorate = (undefined && undefined.__esDecorate) || function (ctor, descriptorIn, decorators, contextIn, initializers, extraInitializers) {
    function accept(f) { if (f !== void 0 && typeof f !== "function") throw new TypeError("Function expected"); return f; }
    var kind = contextIn.kind, key = kind === "getter" ? "get" : kind === "setter" ? "set" : "value";
    var target = !descriptorIn && ctor ? contextIn["static"] ? ctor : ctor.prototype : null;
    var descriptor = descriptorIn || (target ? Object.getOwnPropertyDescriptor(target, contextIn.name) : {});
    var _, done = false;
    for (var i = decorators.length - 1; i >= 0; i--) {
        var context = {};
        for (var p in contextIn) context[p] = p === "access" ? {} : contextIn[p];
        for (var p in contextIn.access) context.access[p] = contextIn.access[p];
        context.addInitializer = function (f) { if (done) throw new TypeError("Cannot add initializers after decoration has completed"); extraInitializers.push(accept(f || null)); };
        var result = (0, decorators[i])(kind === "accessor" ? { get: descriptor.get, set: descriptor.set } : descriptor[key], context);
        if (kind === "accessor") {
            if (result === void 0) continue;
            if (result === null || typeof result !== "object") throw new TypeError("Object expected");
            if (_ = accept(result.get)) descriptor.get = _;
            if (_ = accept(result.set)) descriptor.set = _;
            if (_ = accept(result.init)) initializers.unshift(_);
        }
        else if (_ = accept(result)) {
            if (kind === "field") initializers.unshift(_);
            else descriptor[key] = _;
        }
    }
    if (target) Object.defineProperty(target, contextIn.name, descriptor);
    done = true;
};
var __runInitializers = (undefined && undefined.__runInitializers) || function (thisArg, initializers, value) {
    var useValue = arguments.length > 2;
    for (var i = 0; i < initializers.length; i++) {
        value = useValue ? initializers[i].call(thisArg, value) : initializers[i].call(thisArg);
    }
    return useValue ? value : void 0;
};



let BlackcubeDrawerCustomAttribute = (() => {
    let _classDecorators = [(0,aurelia__WEBPACK_IMPORTED_MODULE_1__.customAttribute)({ name: 'blackcube-drawer' })];
    let _classDescriptor;
    let _classExtraInitializers = [];
    let _classThis;
    var BlackcubeDrawerCustomAttribute = class {
        static { _classThis = this; }
        static {
            const _metadata = typeof Symbol === "function" && Symbol.metadata ? Object.create(null) : void 0;
            __esDecorate(null, _classDescriptor = { value: _classThis }, _classDecorators, { kind: "class", name: _classThis.name, metadata: _metadata }, null, _classExtraInitializers);
            BlackcubeDrawerCustomAttribute = _classThis = _classDescriptor.value;
            if (_metadata) Object.defineProperty(_classThis, Symbol.metadata, { enumerable: true, configurable: true, writable: true, value: _metadata });
            __runInitializers(_classThis, _classExtraInitializers);
        }
        logger;
        element;
        ea;
        p;
        transitionService;
        subscription = null;
        isOpen = false;
        constructor(logger = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.ILogger).scopeTo('blackcube-drawer'), element = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.INode), ea = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.IEventAggregator), p = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.IPlatform), transitionService = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(_services_transition_service__WEBPACK_IMPORTED_MODULE_2__.ITransitionService)) {
            this.logger = logger;
            this.element = element;
            this.ea = ea;
            this.p = p;
            this.transitionService = transitionService;
            this.logger.trace('constructor');
        }
        attaching() {
            this.logger.trace('attaching');
            this.subscription = this.ea.subscribe(_enums_event_aggregator__WEBPACK_IMPORTED_MODULE_3__.Channels.Drawer, this.onDrawer);
            this.element.querySelectorAll('a').forEach((link) => {
                link.addEventListener('click', this.onLinkClick);
            });
            this.element.addEventListener('cancel', this.onCancel);
        }
        detaching() {
            this.logger.trace('detaching');
            this.subscription?.dispose();
            this.element.querySelectorAll('a').forEach((link) => {
                link.removeEventListener('click', this.onLinkClick);
            });
            this.element.removeEventListener('cancel', this.onCancel);
        }
        dispose() {
            this.logger.trace('dispose');
            this.subscription?.dispose();
        }
        onDrawer = (payload) => {
            this.logger.trace('onDrawer', payload.action);
            switch (payload.action) {
                case _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_3__.DrawerAction.Open:
                    this.open();
                    break;
                case _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_3__.DrawerAction.Close:
                    this.close();
                    break;
                case _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_3__.DrawerAction.Toggle:
                    this.isOpen === true ? this.close() : this.open();
                    break;
            }
        };
        onLinkClick = () => {
            this.close();
        };
        onCancel = (event) => {
            event.preventDefault();
            this.close();
        };
        open() {
            if (this.isOpen === true) {
                return;
            }
            this.isOpen = true;
            this.element.showModal();
            this.transitionService.run(this.element, (el) => {
                el.classList.add('open');
            }, (el) => {
                const closeButton = el.querySelector('button[data-drawer="close"]');
                closeButton?.focus();
            });
        }
        close() {
            if (this.isOpen === false) {
                return;
            }
            this.isOpen = false;
            this.transitionService.run(this.element, (el) => {
                el.classList.remove('open');
            }, (el) => {
                el.close();
            });
        }
    };
    return BlackcubeDrawerCustomAttribute = _classThis;
})();



/***/ },

/***/ "./app/attributes/fade-up.ts"
/*!***********************************!*\
  !*** ./app/attributes/fade-up.ts ***!
  \***********************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   BlackcubeFadeUpCustomAttribute: () => (/* binding */ BlackcubeFadeUpCustomAttribute)
/* harmony export */ });
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/kernel/dist/esm/index.dev.mjs");
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/runtime-html/dist/esm/index.dev.mjs");
/**
 * fade-up.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
var __esDecorate = (undefined && undefined.__esDecorate) || function (ctor, descriptorIn, decorators, contextIn, initializers, extraInitializers) {
    function accept(f) { if (f !== void 0 && typeof f !== "function") throw new TypeError("Function expected"); return f; }
    var kind = contextIn.kind, key = kind === "getter" ? "get" : kind === "setter" ? "set" : "value";
    var target = !descriptorIn && ctor ? contextIn["static"] ? ctor : ctor.prototype : null;
    var descriptor = descriptorIn || (target ? Object.getOwnPropertyDescriptor(target, contextIn.name) : {});
    var _, done = false;
    for (var i = decorators.length - 1; i >= 0; i--) {
        var context = {};
        for (var p in contextIn) context[p] = p === "access" ? {} : contextIn[p];
        for (var p in contextIn.access) context.access[p] = contextIn.access[p];
        context.addInitializer = function (f) { if (done) throw new TypeError("Cannot add initializers after decoration has completed"); extraInitializers.push(accept(f || null)); };
        var result = (0, decorators[i])(kind === "accessor" ? { get: descriptor.get, set: descriptor.set } : descriptor[key], context);
        if (kind === "accessor") {
            if (result === void 0) continue;
            if (result === null || typeof result !== "object") throw new TypeError("Object expected");
            if (_ = accept(result.get)) descriptor.get = _;
            if (_ = accept(result.set)) descriptor.set = _;
            if (_ = accept(result.init)) initializers.unshift(_);
        }
        else if (_ = accept(result)) {
            if (kind === "field") initializers.unshift(_);
            else descriptor[key] = _;
        }
    }
    if (target) Object.defineProperty(target, contextIn.name, descriptor);
    done = true;
};
var __runInitializers = (undefined && undefined.__runInitializers) || function (thisArg, initializers, value) {
    var useValue = arguments.length > 2;
    for (var i = 0; i < initializers.length; i++) {
        value = useValue ? initializers[i].call(thisArg, value) : initializers[i].call(thisArg);
    }
    return useValue ? value : void 0;
};

let BlackcubeFadeUpCustomAttribute = (() => {
    let _classDecorators = [(0,aurelia__WEBPACK_IMPORTED_MODULE_1__.customAttribute)({ name: 'blackcube-fade-up' })];
    let _classDescriptor;
    let _classExtraInitializers = [];
    let _classThis;
    var BlackcubeFadeUpCustomAttribute = class {
        static { _classThis = this; }
        static {
            const _metadata = typeof Symbol === "function" && Symbol.metadata ? Object.create(null) : void 0;
            __esDecorate(null, _classDescriptor = { value: _classThis }, _classDecorators, { kind: "class", name: _classThis.name, metadata: _metadata }, null, _classExtraInitializers);
            BlackcubeFadeUpCustomAttribute = _classThis = _classDescriptor.value;
            if (_metadata) Object.defineProperty(_classThis, Symbol.metadata, { enumerable: true, configurable: true, writable: true, value: _metadata });
            __runInitializers(_classThis, _classExtraInitializers);
        }
        logger;
        element;
        p;
        observer = null;
        constructor(logger = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.ILogger).scopeTo('blackcube-fade-up'), element = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.INode), p = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.IPlatform)) {
            this.logger = logger;
            this.element = element;
            this.p = p;
            this.logger.trace('constructor');
        }
        attaching() {
            this.logger.trace('attaching');
            this.observer = new this.p.window.IntersectionObserver(this.onIntersect, {
                threshold: 0.12,
                rootMargin: '0px 0px -30px 0px',
            });
            this.observer.observe(this.element);
        }
        detaching() {
            this.logger.trace('detaching');
            this.observer?.disconnect();
            this.observer = null;
        }
        dispose() {
            this.logger.trace('dispose');
            this.observer?.disconnect();
            this.observer = null;
        }
        onIntersect = (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting === true) {
                    this.element.classList.add('visible');
                    this.observer?.unobserve(this.element);
                }
            });
        };
    };
    return BlackcubeFadeUpCustomAttribute = _classThis;
})();



/***/ },

/***/ "./app/attributes/index.ts"
/*!*********************************!*\
  !*** ./app/attributes/index.ts ***!
  \*********************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   BlackcubeDrawerCustomAttribute: () => (/* reexport safe */ _drawer__WEBPACK_IMPORTED_MODULE_1__.BlackcubeDrawerCustomAttribute),
/* harmony export */   BlackcubeDrawerTriggerCustomAttribute: () => (/* reexport safe */ _drawer_trigger__WEBPACK_IMPORTED_MODULE_2__.BlackcubeDrawerTriggerCustomAttribute),
/* harmony export */   BlackcubeFadeUpCustomAttribute: () => (/* reexport safe */ _fade_up__WEBPACK_IMPORTED_MODULE_3__.BlackcubeFadeUpCustomAttribute),
/* harmony export */   BlackcubeTocCustomAttribute: () => (/* reexport safe */ _toc__WEBPACK_IMPORTED_MODULE_4__.BlackcubeTocCustomAttribute),
/* harmony export */   BlackcubeToggleModeCustomAttribute: () => (/* reexport safe */ _toggle_mode__WEBPACK_IMPORTED_MODULE_0__.BlackcubeToggleModeCustomAttribute),
/* harmony export */   CodeHighlight: () => (/* reexport safe */ _code_highlight__WEBPACK_IMPORTED_MODULE_5__.CodeHighlight)
/* harmony export */ });
/* harmony import */ var _toggle_mode__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./toggle-mode */ "./app/attributes/toggle-mode.ts");
/* harmony import */ var _drawer__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./drawer */ "./app/attributes/drawer.ts");
/* harmony import */ var _drawer_trigger__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./drawer-trigger */ "./app/attributes/drawer-trigger.ts");
/* harmony import */ var _fade_up__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./fade-up */ "./app/attributes/fade-up.ts");
/* harmony import */ var _toc__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./toc */ "./app/attributes/toc.ts");
/* harmony import */ var _code_highlight__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./code-highlight */ "./app/attributes/code-highlight.ts");








/***/ },

/***/ "./app/attributes/toc.ts"
/*!*******************************!*\
  !*** ./app/attributes/toc.ts ***!
  \*******************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   BlackcubeTocCustomAttribute: () => (/* binding */ BlackcubeTocCustomAttribute)
/* harmony export */ });
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/kernel/dist/esm/index.dev.mjs");
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/runtime-html/dist/esm/index.dev.mjs");
/**
 * toc.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
var __esDecorate = (undefined && undefined.__esDecorate) || function (ctor, descriptorIn, decorators, contextIn, initializers, extraInitializers) {
    function accept(f) { if (f !== void 0 && typeof f !== "function") throw new TypeError("Function expected"); return f; }
    var kind = contextIn.kind, key = kind === "getter" ? "get" : kind === "setter" ? "set" : "value";
    var target = !descriptorIn && ctor ? contextIn["static"] ? ctor : ctor.prototype : null;
    var descriptor = descriptorIn || (target ? Object.getOwnPropertyDescriptor(target, contextIn.name) : {});
    var _, done = false;
    for (var i = decorators.length - 1; i >= 0; i--) {
        var context = {};
        for (var p in contextIn) context[p] = p === "access" ? {} : contextIn[p];
        for (var p in contextIn.access) context.access[p] = contextIn.access[p];
        context.addInitializer = function (f) { if (done) throw new TypeError("Cannot add initializers after decoration has completed"); extraInitializers.push(accept(f || null)); };
        var result = (0, decorators[i])(kind === "accessor" ? { get: descriptor.get, set: descriptor.set } : descriptor[key], context);
        if (kind === "accessor") {
            if (result === void 0) continue;
            if (result === null || typeof result !== "object") throw new TypeError("Object expected");
            if (_ = accept(result.get)) descriptor.get = _;
            if (_ = accept(result.set)) descriptor.set = _;
            if (_ = accept(result.init)) initializers.unshift(_);
        }
        else if (_ = accept(result)) {
            if (kind === "field") initializers.unshift(_);
            else descriptor[key] = _;
        }
    }
    if (target) Object.defineProperty(target, contextIn.name, descriptor);
    done = true;
};
var __runInitializers = (undefined && undefined.__runInitializers) || function (thisArg, initializers, value) {
    var useValue = arguments.length > 2;
    for (var i = 0; i < initializers.length; i++) {
        value = useValue ? initializers[i].call(thisArg, value) : initializers[i].call(thisArg);
    }
    return useValue ? value : void 0;
};

let BlackcubeTocCustomAttribute = (() => {
    let _classDecorators = [(0,aurelia__WEBPACK_IMPORTED_MODULE_1__.customAttribute)({ name: 'blackcube-toc' })];
    let _classDescriptor;
    let _classExtraInitializers = [];
    let _classThis;
    let _target_decorators;
    let _target_initializers = [];
    let _target_extraInitializers = [];
    let _title_decorators;
    let _title_initializers = [];
    let _title_extraInitializers = [];
    var BlackcubeTocCustomAttribute = class {
        static { _classThis = this; }
        static {
            const _metadata = typeof Symbol === "function" && Symbol.metadata ? Object.create(null) : void 0;
            _target_decorators = [(0,aurelia__WEBPACK_IMPORTED_MODULE_1__.bindable)()];
            _title_decorators = [(0,aurelia__WEBPACK_IMPORTED_MODULE_1__.bindable)()];
            __esDecorate(null, null, _target_decorators, { kind: "field", name: "target", static: false, private: false, access: { has: obj => "target" in obj, get: obj => obj.target, set: (obj, value) => { obj.target = value; } }, metadata: _metadata }, _target_initializers, _target_extraInitializers);
            __esDecorate(null, null, _title_decorators, { kind: "field", name: "title", static: false, private: false, access: { has: obj => "title" in obj, get: obj => obj.title, set: (obj, value) => { obj.title = value; } }, metadata: _metadata }, _title_initializers, _title_extraInitializers);
            __esDecorate(null, _classDescriptor = { value: _classThis }, _classDecorators, { kind: "class", name: _classThis.name, metadata: _metadata }, null, _classExtraInitializers);
            BlackcubeTocCustomAttribute = _classThis = _classDescriptor.value;
            if (_metadata) Object.defineProperty(_classThis, Symbol.metadata, { enumerable: true, configurable: true, writable: true, value: _metadata });
            __runInitializers(_classThis, _classExtraInitializers);
        }
        logger;
        element;
        p;
        target = __runInitializers(this, _target_initializers, 'main');
        title = (__runInitializers(this, _target_extraInitializers), __runInitializers(this, _title_initializers, 'On this page'));
        headings = (__runInitializers(this, _title_extraInitializers), []);
        links = [];
        observer = null;
        constructor(logger = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.ILogger).scopeTo('blackcube-toc'), element = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.INode), p = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.IPlatform)) {
            this.logger = logger;
            this.element = element;
            this.p = p;
            this.logger.trace('constructor');
        }
        attached() {
            this.logger.trace('attached');
            const targetEl = this.p.document.querySelector(this.target);
            if (targetEl === null) {
                this.element.style.display = 'none';
                return;
            }
            const nodes = targetEl.querySelectorAll('h2, h3');
            if (nodes.length === 0) {
                this.element.style.display = 'none';
                return;
            }
            this.collectHeadings(nodes);
            this.render();
            this.observe(nodes);
        }
        detaching() {
            this.logger.trace('detaching');
            this.observer?.disconnect();
            this.observer = null;
        }
        dispose() {
            this.logger.trace('dispose');
            this.observer?.disconnect();
            this.observer = null;
        }
        collectHeadings(nodes) {
            this.headings = [];
            nodes.forEach((node, i) => {
                const heading = node;
                if (heading.id === '') {
                    heading.id = 'heading-' + i;
                }
                this.headings.push({
                    id: heading.id,
                    text: heading.textContent?.trim() ?? '',
                    level: parseInt(heading.tagName.substring(1), 10),
                });
            });
        }
        render() {
            const titleEl = this.p.document.createElement('p');
            titleEl.className = 'text-xs font-semibold text-secondary-500 dark:text-secondary-400 uppercase tracking-wider mb-3';
            titleEl.textContent = this.title;
            const nav = this.p.document.createElement('div');
            nav.className = 'space-y-1 border-l-2 border-secondary-200 dark:border-secondary-700';
            for (const heading of this.headings) {
                const link = this.p.document.createElement('a');
                link.href = '#' + heading.id;
                link.textContent = heading.text;
                link.className = 'block py-1 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-700 dark:hover:text-primary-400 border-l-2 -ml-px border-transparent hover:border-primary-500';
                link.classList.add(heading.level === 2 ? 'pl-4' : 'pl-8');
                this.links.push(link);
                nav.appendChild(link);
            }
            this.element.innerHTML = '';
            this.element.appendChild(titleEl);
            this.element.appendChild(nav);
        }
        observe(nodes) {
            this.observer = new this.p.window.IntersectionObserver(this.onIntersect, {
                rootMargin: '-80px 0px -60% 0px',
                threshold: 0,
            });
            nodes.forEach((node) => this.observer?.observe(node));
        }
        onIntersect = (entries) => {
            for (const entry of entries) {
                if (entry.isIntersecting === true) {
                    this.setActive(entry.target.id);
                    break;
                }
            }
        };
        setActive(id) {
            const activeClasses = ['border-primary-500', 'text-primary-700', 'dark:text-primary-400', 'font-medium'];
            const inactiveClasses = ['border-transparent', 'text-secondary-600', 'dark:text-secondary-400'];
            for (const link of this.links) {
                const linkId = link.getAttribute('href')?.substring(1) ?? '';
                link.classList.remove(...activeClasses, ...inactiveClasses);
                if (linkId === id) {
                    link.classList.add(...activeClasses);
                }
                else {
                    link.classList.add(...inactiveClasses);
                }
            }
        }
    };
    return BlackcubeTocCustomAttribute = _classThis;
})();



/***/ },

/***/ "./app/attributes/toggle-mode.ts"
/*!***************************************!*\
  !*** ./app/attributes/toggle-mode.ts ***!
  \***************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   BlackcubeToggleModeCustomAttribute: () => (/* binding */ BlackcubeToggleModeCustomAttribute)
/* harmony export */ });
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/kernel/dist/esm/index.dev.mjs");
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/runtime-html/dist/esm/index.dev.mjs");
/* harmony import */ var _services_storage_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../services/storage-service */ "./app/services/storage-service.ts");
/* harmony import */ var _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../enums/event-aggregator */ "./app/enums/event-aggregator.ts");
/**
 * toggle-mode.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
var __esDecorate = (undefined && undefined.__esDecorate) || function (ctor, descriptorIn, decorators, contextIn, initializers, extraInitializers) {
    function accept(f) { if (f !== void 0 && typeof f !== "function") throw new TypeError("Function expected"); return f; }
    var kind = contextIn.kind, key = kind === "getter" ? "get" : kind === "setter" ? "set" : "value";
    var target = !descriptorIn && ctor ? contextIn["static"] ? ctor : ctor.prototype : null;
    var descriptor = descriptorIn || (target ? Object.getOwnPropertyDescriptor(target, contextIn.name) : {});
    var _, done = false;
    for (var i = decorators.length - 1; i >= 0; i--) {
        var context = {};
        for (var p in contextIn) context[p] = p === "access" ? {} : contextIn[p];
        for (var p in contextIn.access) context.access[p] = contextIn.access[p];
        context.addInitializer = function (f) { if (done) throw new TypeError("Cannot add initializers after decoration has completed"); extraInitializers.push(accept(f || null)); };
        var result = (0, decorators[i])(kind === "accessor" ? { get: descriptor.get, set: descriptor.set } : descriptor[key], context);
        if (kind === "accessor") {
            if (result === void 0) continue;
            if (result === null || typeof result !== "object") throw new TypeError("Object expected");
            if (_ = accept(result.get)) descriptor.get = _;
            if (_ = accept(result.set)) descriptor.set = _;
            if (_ = accept(result.init)) initializers.unshift(_);
        }
        else if (_ = accept(result)) {
            if (kind === "field") initializers.unshift(_);
            else descriptor[key] = _;
        }
    }
    if (target) Object.defineProperty(target, contextIn.name, descriptor);
    done = true;
};
var __runInitializers = (undefined && undefined.__runInitializers) || function (thisArg, initializers, value) {
    var useValue = arguments.length > 2;
    for (var i = 0; i < initializers.length; i++) {
        value = useValue ? initializers[i].call(thisArg, value) : initializers[i].call(thisArg);
    }
    return useValue ? value : void 0;
};



const STORAGE_KEY = 'bc-mode';
let BlackcubeToggleModeCustomAttribute = (() => {
    let _classDecorators = [(0,aurelia__WEBPACK_IMPORTED_MODULE_1__.customAttribute)({ name: 'blackcube-toggle-mode' })];
    let _classDescriptor;
    let _classExtraInitializers = [];
    let _classThis;
    var BlackcubeToggleModeCustomAttribute = class {
        static { _classThis = this; }
        static {
            const _metadata = typeof Symbol === "function" && Symbol.metadata ? Object.create(null) : void 0;
            __esDecorate(null, _classDescriptor = { value: _classThis }, _classDecorators, { kind: "class", name: _classThis.name, metadata: _metadata }, null, _classExtraInitializers);
            BlackcubeToggleModeCustomAttribute = _classThis = _classDescriptor.value;
            if (_metadata) Object.defineProperty(_classThis, Symbol.metadata, { enumerable: true, configurable: true, writable: true, value: _metadata });
            __runInitializers(_classThis, _classExtraInitializers);
        }
        logger;
        element;
        ea;
        p;
        storage;
        subscription = null;
        constructor(logger = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.ILogger).scopeTo('blackcube-toggle-mode'), element = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.INode), ea = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.IEventAggregator), p = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.IPlatform), storage = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(_services_storage_service__WEBPACK_IMPORTED_MODULE_2__.IStorageService)) {
            this.logger = logger;
            this.element = element;
            this.ea = ea;
            this.p = p;
            this.storage = storage;
            this.logger.trace('constructor');
        }
        attaching() {
            this.logger.trace('attaching');
            this.element.addEventListener('click', this.onClick);
            this.subscription = this.ea.subscribe(_enums_event_aggregator__WEBPACK_IMPORTED_MODULE_3__.Channels.Mode, this.onMode);
        }
        detaching() {
            this.logger.trace('detaching');
            this.element.removeEventListener('click', this.onClick);
            this.subscription?.dispose();
        }
        dispose() {
            this.logger.trace('dispose');
            this.subscription?.dispose();
        }
        onClick = (event) => {
            event.preventDefault();
            this.ea.publish(_enums_event_aggregator__WEBPACK_IMPORTED_MODULE_3__.Channels.Mode, { action: _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_3__.ModeAction.Toggle });
        };
        onMode = (payload) => {
            this.logger.trace('onMode', payload.action);
            const root = this.p.document.documentElement;
            switch (payload.action) {
                case _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_3__.ModeAction.Toggle:
                    root.classList.toggle('dark');
                    break;
                case _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_3__.ModeAction.SetDark:
                    root.classList.add('dark');
                    break;
                case _enums_event_aggregator__WEBPACK_IMPORTED_MODULE_3__.ModeAction.SetLight:
                    root.classList.remove('dark');
                    break;
            }
            const isDark = root.classList.contains('dark');
            this.storage.save(STORAGE_KEY, isDark === true ? 'dark' : 'light');
        };
    };
    return BlackcubeToggleModeCustomAttribute = _classThis;
})();



/***/ },

/***/ "./app/enhance.ts"
/*!************************!*\
  !*** ./app/enhance.ts ***!
  \************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Enhance: () => (/* binding */ Enhance)
/* harmony export */ });
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/kernel/dist/esm/index.dev.mjs");

class Enhance {
    logger;
    constructor(logger = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.ILogger).scopeTo('Enhance')) {
        this.logger = logger;
        this.logger.debug('constructor');
    }
    attaching() {
        this.logger.debug('Attaching');
    }
}


/***/ },

/***/ "./app/enums/event-aggregator.ts"
/*!***************************************!*\
  !*** ./app/enums/event-aggregator.ts ***!
  \***************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Channels: () => (/* binding */ Channels),
/* harmony export */   DrawerAction: () => (/* binding */ DrawerAction),
/* harmony export */   ModeAction: () => (/* binding */ ModeAction)
/* harmony export */ });
/**
 * event-aggregator.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
var Channels;
(function (Channels) {
    Channels["Mode"] = "blackcube:mode";
    Channels["Drawer"] = "blackcube:drawer";
})(Channels || (Channels = {}));
var ModeAction;
(function (ModeAction) {
    ModeAction["Toggle"] = "toggle";
    ModeAction["SetDark"] = "set-dark";
    ModeAction["SetLight"] = "set-light";
})(ModeAction || (ModeAction = {}));
var DrawerAction;
(function (DrawerAction) {
    DrawerAction["Open"] = "open";
    DrawerAction["Close"] = "close";
    DrawerAction["Toggle"] = "toggle";
})(DrawerAction || (DrawerAction = {}));


/***/ },

/***/ "./app/plugins/tarteaucitron/configure.ts"
/*!************************************************!*\
  !*** ./app/plugins/tarteaucitron/configure.ts ***!
  \************************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Configure: () => (/* binding */ Configure),
/* harmony export */   ITarteaucitronConfiguration: () => (/* binding */ ITarteaucitronConfiguration)
/* harmony export */ });
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/kernel/dist/esm/index.dev.mjs");
/**
 * configure.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

const ITarteaucitronConfiguration = aurelia__WEBPACK_IMPORTED_MODULE_0__.DI.createInterface('ITarteaucitronConfiguration', x => x.singleton(Configure));
class Configure {
    _config = {
        privacyUrl: '',
        bodyPosition: 'bottom',
        hashtag: '#tarteaucitron',
        cookieName: 'tarteaucitron',
        orientation: 'middle',
        groupServices: false,
        showDetailsOnClick: true,
        serviceDefaultState: 'wait',
        showAlertSmall: false,
        cookieslist: false,
        cookieslistEmbed: false,
        showIcon: true,
        iconPosition: 'BottomRight',
        adblocker: false,
        DenyAllCta: true,
        AcceptAllCta: true,
        highPrivacy: true,
        alwaysNeedConsent: false,
        handleBrowserDNTRequest: false,
        removeCredit: false,
        moreInfoLink: true,
        useExternalCss: true,
        useExternalJs: false,
        readmoreLink: '',
        mandatory: true,
        mandatoryCta: true,
        googleConsentMode: true,
        bingConsentMode: true,
        pianoConsentMode: true,
        pianoConsentModeEssential: false,
        softConsentMode: false,
        dataLayer: false,
        serverSide: false,
        partnersList: false,
    };
    _services = [];
    _userOptions = {};
    _container = null;
    setContainer(container) {
        this._container = container;
    }
    getContainer() {
        return this._container;
    }
    getConfig() {
        return this._config;
    }
    get(key) {
        return this._config[key];
    }
    set(key, val) {
        this._config[key] = val;
        return val;
    }
    getServices() {
        return this._services;
    }
    setServices(services) {
        this._services = services;
    }
    getUserOptions() {
        return this._userOptions;
    }
    setUserOptions(options) {
        this._userOptions = options;
    }
}


/***/ },

/***/ "./app/plugins/tarteaucitron/index.ts"
/*!********************************************!*\
  !*** ./app/plugins/tarteaucitron/index.ts ***!
  \********************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Configure: () => (/* reexport safe */ _configure__WEBPACK_IMPORTED_MODULE_2__.Configure),
/* harmony export */   ITarteaucitronConfiguration: () => (/* reexport safe */ _configure__WEBPACK_IMPORTED_MODULE_2__.ITarteaucitronConfiguration),
/* harmony export */   TarteaucitronConfiguration: () => (/* binding */ TarteaucitronConfiguration),
/* harmony export */   TarteaucitronService: () => (/* binding */ TarteaucitronService)
/* harmony export */ });
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/kernel/dist/esm/index.dev.mjs");
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/runtime-html/dist/esm/index.dev.mjs");
/* harmony import */ var _configure__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./configure */ "./app/plugins/tarteaucitron/configure.ts");
/**
 * index.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */


class TarteaucitronService {
    config;
    logger;
    p;
    constructor(config = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(_configure__WEBPACK_IMPORTED_MODULE_2__.ITarteaucitronConfiguration), logger = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.ILogger).scopeTo('tarteaucitron'), p = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.IPlatform)) {
        this.config = config;
        this.logger = logger;
        this.p = p;
        this.logger.trace('constructor');
        if (this.p.window.tarteaucitron === undefined) {
            this.logger.error('tarteaucitron not loaded — register TarteAuCitronAsset before AppAsset');
            return;
        }
        const tac = this.p.window.tarteaucitron;
        if (tac.user === undefined) {
            tac.user = {};
        }
        const userOptions = this.config.getUserOptions();
        for (const key of Object.keys(userOptions)) {
            tac.user[key] = userOptions[key];
        }
        tac.init(this.config.getConfig());
        if (tac.job === undefined) {
            tac.job = [];
        }
        const services = this.config.getServices();
        for (const service of services) {
            tac.job.push(service);
        }
    }
}
function createTarteaucitronConfiguration(input) {
    return {
        register(container) {
            const configClass = container.get(_configure__WEBPACK_IMPORTED_MODULE_2__.ITarteaucitronConfiguration);
            configClass.setContainer(container);
            if (input !== undefined) {
                if (input.services !== undefined) {
                    configClass.setServices(input.services);
                }
                if (input.options !== undefined) {
                    configClass.setUserOptions(input.options);
                }
                if (input.init !== undefined) {
                    Object.assign(configClass.getConfig(), input.init);
                }
            }
            container.register(TarteaucitronService);
            container.get(TarteaucitronService);
            return container;
        },
        customize(input) {
            return createTarteaucitronConfiguration(input);
        }
    };
}
const TarteaucitronConfiguration = createTarteaucitronConfiguration();



/***/ },

/***/ "./app/services/storage-service.ts"
/*!*****************************************!*\
  !*** ./app/services/storage-service.ts ***!
  \*****************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   IStorageService: () => (/* binding */ IStorageService),
/* harmony export */   StorageService: () => (/* binding */ StorageService)
/* harmony export */ });
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/kernel/dist/esm/index.dev.mjs");

const IStorageService = /*@__PURE__*/ aurelia__WEBPACK_IMPORTED_MODULE_0__.DI.createInterface('IStorageService', (x) => x.singleton(StorageService));
class StorageService {
    logger;
    constructor(logger = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.ILogger).scopeTo('StorageService')) {
        this.logger = logger;
        this.logger.trace('constructor');
    }
    load(key, def = null) {
        this.logger.trace('load', key);
        const value = localStorage.getItem(key);
        if (value === null) {
            return def;
        }
        return JSON.parse(value);
    }
    save(key, value) {
        this.logger.trace('save', key, value);
        localStorage.setItem(key, JSON.stringify(value));
    }
    remove(key) {
        this.logger.trace('remove', key);
        localStorage.removeItem(key);
    }
}


/***/ },

/***/ "./app/services/transition-service.ts"
/*!********************************************!*\
  !*** ./app/services/transition-service.ts ***!
  \********************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   ITransitionService: () => (/* binding */ ITransitionService),
/* harmony export */   TransitionService: () => (/* binding */ TransitionService)
/* harmony export */ });
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/kernel/dist/esm/index.dev.mjs");
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/runtime-html/dist/esm/index.dev.mjs");

const ITransitionService = /*@__PURE__*/ aurelia__WEBPACK_IMPORTED_MODULE_0__.DI.createInterface('ITransitionService', (x) => x.singleton(TransitionService));
class TransitionService {
    logger;
    p;
    securityTimeout = 2000;
    constructor(logger = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_0__.ILogger).scopeTo('TransitionService'), p = (0,aurelia__WEBPACK_IMPORTED_MODULE_0__.resolve)(aurelia__WEBPACK_IMPORTED_MODULE_1__.IPlatform)) {
        this.logger = logger;
        this.p = p;
        this.logger.trace('constructor');
    }
    run(element, before, after) {
        let securityTimeout = undefined;
        const endTransition = (evt) => {
            if (securityTimeout !== undefined) {
                this.p.clearTimeout(securityTimeout);
                securityTimeout = undefined;
            }
            element.removeEventListener('transitionend', endTransition);
            if (after) {
                this.logger.trace('after()');
                after(element);
            }
        };
        if (before) {
            securityTimeout = this.p.setTimeout(endTransition, this.securityTimeout);
            element.addEventListener('transitionend', endTransition);
            this.p.requestAnimationFrame(() => {
                this.logger.trace('before()');
                before(element);
            });
        }
    }
}


/***/ },

/***/ "./startup.ts"
/*!********************!*\
  !*** ./startup.ts ***!
  \********************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _css_main_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./css/main.css */ "./css/main.css");
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/aurelia/dist/esm/index.dev.mjs");
/* harmony import */ var aurelia__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! aurelia */ "../../../../node_modules/@aurelia/kernel/dist/esm/index.dev.mjs");
/* harmony import */ var _app_enhance__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./app/enhance */ "./app/enhance.ts");
/* harmony import */ var _app_attributes_index__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./app/attributes/index */ "./app/attributes/index.ts");
/* harmony import */ var _app_plugins_tarteaucitron__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./app/plugins/tarteaucitron */ "./app/plugins/tarteaucitron/index.ts");





if (window.webpackBaseUrl) {
    __webpack_require__.p = webpackBaseUrl;
}
else {
    __webpack_require__.p = '';
}
const page = globalThis['document'].body;
const au = new aurelia__WEBPACK_IMPORTED_MODULE_1__["default"]();
if (true) {
    au.register(aurelia__WEBPACK_IMPORTED_MODULE_2__.LoggerConfiguration.create({
        level: aurelia__WEBPACK_IMPORTED_MODULE_2__.LogLevel.trace,
        colorOptions: 'colors',
        sinks: [aurelia__WEBPACK_IMPORTED_MODULE_2__.ConsoleSink]
    }));
}
else // removed by dead control flow
{}
au.register(_app_attributes_index__WEBPACK_IMPORTED_MODULE_4__);
if (tac) {
    au.register(_app_plugins_tarteaucitron__WEBPACK_IMPORTED_MODULE_5__.TarteaucitronConfiguration.customize(tac));
}
au.enhance({
    host: page,
    component: _app_enhance__WEBPACK_IMPORTED_MODULE_3__.Enhance
});


/***/ }

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors"], () => (__webpack_exec__("./startup.ts")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=app.js.map