import './css/main.css';

import Aurelia, { ConsoleSink, LoggerConfiguration, LogLevel } from 'aurelia';
import { BleetConfiguration } from '@blackcube/aurelia-kit';
import { PrismjsConfiguration } from '@blackcube/aurelia-bridge-prismjs';
import {Enhance} from "./app/enhance";
import * as globalAttributes from './app/attributes/index';

declare var webpackBaseUrl: string;
declare var __webpack_public_path__: string;
if ((window as any).webpackBaseUrl) {
    __webpack_public_path__ = webpackBaseUrl;
} else {
    __webpack_public_path__ = '';
}

declare var PRODUCTION:boolean;

const page = globalThis['document'].body as HTMLElement;
const au = new Aurelia();

if(typeof PRODUCTION === 'undefined' || PRODUCTION == false) {
    au.register(LoggerConfiguration.create({
        level: LogLevel.trace,
        colorOptions: 'colors',
        sinks: [ConsoleSink]
    }));
} else {
    au.register(LoggerConfiguration.create({
        level: LogLevel.error,
        colorOptions: 'colors',
        sinks: [ConsoleSink]
    }));
}
au.register(BleetConfiguration);
au.register(PrismjsConfiguration);
au.register(globalAttributes);
au.enhance({
    host: page,
    component: Enhance
});
