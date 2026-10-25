/**
 * fade-up.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

import {customAttribute, ILogger, INode, IPlatform, resolve} from 'aurelia';

@customAttribute({name: 'blackcube-fade-up'})
export class BlackcubeFadeUpCustomAttribute {
    private observer: IntersectionObserver | null = null;

    public constructor(
        private readonly logger: ILogger = resolve(ILogger).scopeTo('blackcube-fade-up'),
        private readonly element: HTMLElement = resolve(INode) as HTMLElement,
        private readonly p: IPlatform = resolve(IPlatform),
    ) {
        this.logger.trace('constructor');
    }

    public attaching() {
        this.logger.trace('attaching');
        this.observer = new this.p.window.IntersectionObserver(this.onIntersect, {
            threshold: 0.12,
            rootMargin: '0px 0px -30px 0px',
        });
        this.observer.observe(this.element);
    }

    public detaching() {
        this.logger.trace('detaching');
        this.observer?.disconnect();
        this.observer = null;
    }

    public dispose() {
        this.logger.trace('dispose');
        this.observer?.disconnect();
        this.observer = null;
    }

    private onIntersect = (entries: IntersectionObserverEntry[]) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting === true) {
                this.element.classList.add('visible');
                this.observer?.unobserve(this.element);
            }
        });
    };
}
